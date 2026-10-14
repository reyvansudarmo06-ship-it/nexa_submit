<?php

namespace App\Services\AI;

use App\Services\SubmissionTextExtractor;
use Illuminate\Support\Facades\Http;
use RuntimeException;

class NexaAiService
{
    protected string $url;
    protected string $model;

    public function __construct()
    {
        $this->url = rtrim(
            (string) config(
                'services.ollama.url',
                'http://127.0.0.1:11434'
            ),
            '/'
        );

        $this->model = trim(
            (string) config(
                'services.ollama.model',
                'qwen2.5:3b'
            )
        );
    }

    protected function ask(string $prompt): string
    {
        if ($this->url === '' || $this->model === '') {
            throw new RuntimeException(
                'URL atau model Ollama belum dikonfigurasi.'
            );
        }

        try {
            $response = Http::acceptJson()
                ->asJson()
                ->timeout(180)
                ->connectTimeout(20)
                ->post($this->url . '/api/chat', [
                    'model' => $this->model,
                    'messages' => [
                        [
                            'role' => 'user',
                            'content' => $prompt,
                        ],
                    ],
                    'stream' => false,
                    'format' => 'json',
                    'options' => [
                        'temperature' => 0.2,
                    ],
                ]);
        } catch (\Throwable $e) {
            throw new RuntimeException(
                'Tidak bisa terhubung ke Ollama. ' .
                'Pastikan Ollama dan Cloudflare Tunnel aktif. ' .
                'Detail: ' . $e->getMessage(),
                0,
                $e
            );
        }

        if (!$response->successful()) {
            throw new RuntimeException(
                'Ollama gagal merespons dengan HTTP ' .
                $response->status() . '. ' .
                mb_substr($response->body(), 0, 500)
            );
        }

        $answer = $response->json('message.content');

        if (!is_string($answer) || trim($answer) === '') {
            throw new RuntimeException(
                'Ollama berhasil merespons, tetapi jawabannya kosong.'
            );
        }

        return trim($answer);
    }

    public function analyze(
        string $instruction,
        string $answer
    ): array {
        $prompt = <<<PROMPT
Kamu adalah AI pemeriksa tugas sekolah NEXA SUBMIT.

INSTRUKSI TUGAS:
{$instruction}

ISI JAWABAN SISWA:
{$answer}

Nilai berdasarkan bukti yang tersedia. Jangan mengarang isi file.
Berikan skor 0-100 untuk setiap kategori.

Balas hanya dengan JSON berstruktur:
{
  "scores": {
    "instruction": 0,
    "completeness": 0,
    "quality": 0,
    "neatness": 0
  },
  "content_preview": "Ringkasan isi jawaban",
  "strengths": ["Kelebihan yang ditemukan"],
  "weaknesses": ["Kekurangan yang ditemukan"],
  "suggestions": ["Saran perbaikan"]
}

Semua skor berupa angka 0 sampai 100.
Jika bukti tidak cukup, jelaskan keterbatasannya.
PROMPT;

        $data = json_decode($this->ask($prompt), true);

        if (
            !is_array($data) ||
            !is_array($data['scores'] ?? null)
        ) {
            throw new RuntimeException(
                'Format hasil analisis Ollama tidak valid.'
            );
        }

        $scores = $data['scores'];

        foreach ([
            'instruction',
            'completeness',
            'quality',
            'neatness',
        ] as $key) {
            if (
                !isset($scores[$key]) ||
                !is_numeric($scores[$key])
            ) {
                throw new RuntimeException(
                    "Skor {$key} tidak valid."
                );
            }

            $scores[$key] = max(
                0,
                min(100, (float) $scores[$key])
            );
        }

        return [
            'success' => true,
            'scores' => $scores,
            'content_preview' => (string) (
                $data['content_preview'] ?? ''
            ),
            'strengths' => is_array($data['strengths'] ?? null)
                ? $data['strengths'] : [],
            'weaknesses' => is_array($data['weaknesses'] ?? null)
                ? $data['weaknesses'] : [],
            'suggestions' => is_array($data['suggestions'] ?? null)
                ? $data['suggestions'] : [],
        ];
    }

    public function analyzeFile(
        string $filePath,
        string $instruction
    ): array {
        if (!is_file($filePath)) {
            throw new RuntimeException(
                'File tugas tidak ditemukan.'
            );
        }

        $extractor = app(SubmissionTextExtractor::class);

        $mimeType = mime_content_type($filePath)
            ?: 'application/octet-stream';

        $text = trim(
            $extractor->extract($filePath, $mimeType)
        );

        if ($text === '') {
            throw new RuntimeException(
                'Teks file tidak bisa dibaca atau formatnya belum didukung.'
            );
        }

        return $this->analyze($instruction, $text);
    }

    public function chat(
        string $instruction,
        string $message
    ): array {
        $prompt = <<<PROMPT
Kamu adalah NEXA AI, asisten siswa dalam aplikasi NEXA SUBMIT.

Gunakan bahasa Indonesia yang ramah, jelas, dan mudah dipahami.
Jawab pertanyaan secara langsung.
Jangan mengulang pertanyaan tanpa alasan.
Jika informasi kurang, ajukan maksimal satu pertanyaan klarifikasi.
Jangan mengarang data atau mengaku melakukan tindakan yang belum dilakukan.

KONTEKS:
{$instruction}

PESAN SISWA:
{$message}

Balas hanya dengan JSON:
{"response":"Jawaban untuk siswa"}
PROMPT;

        $data = json_decode($this->ask($prompt), true);

        if (
            !is_array($data) ||
            !is_string($data['response'] ?? null) ||
            trim($data['response']) === ''
        ) {
            throw new RuntimeException(
                'Format jawaban chat Ollama tidak valid.'
            );
        }

        return [
            'success' => true,
            'response' => trim($data['response']),
        ];
    }
}
