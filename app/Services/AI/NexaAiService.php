<?php

namespace App\Services\AI;

use App\Services\SubmissionTextExtractor;
use Illuminate\Support\Facades\Http;
use RuntimeException;

class NexaAiService
{
    protected string $url;
    protected string $model;
    protected string $apiKey;

    public function __construct()
    {
        $this->url = (string) config(
            'services.groq.url',
            'https://api.groq.com/openai/v1/chat/completions'
        );

        $this->model = (string) config(
            'services.groq.model',
            'openai/gpt-oss-20b'
        );

        // Ambil key dari konfigurasi Laravel terlebih dahulu.
        $key = config('services.groq.key');

        // Fallback jika konfigurasi Laravel kosong.
        if (!is_string($key) || trim($key) === '') {
            $key = getenv('GROQ_API_KEY') ?: '';
        }

        $this->apiKey = trim((string) $key);
    }

    protected function ask(string $prompt): string
    {
        if ($this->apiKey === '') {
            throw new RuntimeException(
                'GROQ_API_KEY tidak terbaca oleh service Laravel. ' .
                'Pastikan variabel tersedia pada service nexa-submit.'
            );
        }

        $response = Http::withToken($this->apiKey)
            ->acceptJson()
            ->asJson()
            ->timeout(120)
            ->connectTimeout(15)
            ->post($this->url, [
                'model' => $this->model,
                'messages' => [
                    [
                        'role' => 'user',
                        'content' => $prompt,
                    ],
                ],
                'temperature' => 0.2,
                'response_format' => [
                    'type' => 'json_object',
                ],
            ]);

        if (!$response->successful()) {
            $status = $response->status();

            if ($status === 429) {
                throw new RuntimeException(
                    'Batas permintaan Groq tercapai. Coba lagi nanti.'
                );
            }

            if ($status === 401 || $status === 403) {
                throw new RuntimeException(
                    'API key Groq tidak valid atau akses model ditolak.'
                );
            }

            throw new RuntimeException(
                'Groq API gagal. HTTP ' . $status
            );
        }

        $answer = $response->json('choices.0.message.content');

        if (!is_string($answer) || trim($answer) === '') {
            throw new RuntimeException(
                'Groq tidak memberikan jawaban.'
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

Balas dengan JSON yang memiliki struktur:
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
                'Format hasil analisis Groq tidak valid.'
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

        $text = trim($extractor->extract(
            $filePath,
            mime_content_type($filePath)
                ?: 'application/octet-stream'
        ));

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

Balas dengan JSON:
{"response":"Jawaban untuk siswa"}
PROMPT;

        $data = json_decode($this->ask($prompt), true);

        if (
            !is_array($data) ||
            !is_string($data['response'] ?? null) ||
            trim($data['response']) === ''
        ) {
            throw new RuntimeException(
                'Format jawaban chat Groq tidak valid.'
            );
        }

        return [
            'success' => true,
            'response' => trim($data['response']),
        ];
    }
}