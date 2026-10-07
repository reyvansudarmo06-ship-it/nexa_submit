<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use RuntimeException;

class NexaAiService
{
    protected string $url = 'http://127.0.0.1:5001';

    public function analyze(
        string $instruction,
        string $answer
    ): array {
        $response = Http::timeout(120)
            ->connectTimeout(10)
            ->post($this->url . '/analyze', [
                'instruction' => $instruction,
                'answer' => $answer,
            ]);

        if (!$response->successful()) {
            throw new RuntimeException(
                'NEXA AI lokal error: ' . $response->body()
            );
        }

        $data = $response->json();

        if (!is_array($data) || !($data['success'] ?? false)) {
            throw new RuntimeException(
                $data['message'] ?? 'NEXA AI lokal memberikan response tidak valid.'
            );
        }

        return $data;
    }

    public function generate(
        string $prompt,
        bool $webSearch = false
    ): string {
        $response = Http::timeout(120)
            ->connectTimeout(10)
            ->post($this->url . '/chat', [
                'instruction' => $prompt,
                'message' => $prompt,
            ]);

        if (!$response->successful()) {
            throw new RuntimeException(
                'NEXA AI lokal error: ' . $response->body()
            );
        }

        $data = $response->json();

        if (!is_array($data) || !($data['success'] ?? false)) {
            throw new RuntimeException(
                $data['message'] ?? 'NEXA AI lokal memberikan response tidak valid.'
            );
        }

        $result = trim($data['response'] ?? '');

        if ($result === '') {
            throw new RuntimeException(
                'NEXA AI lokal tidak memberikan jawaban.'
            );
        }

        return $result;
    }
}