<?php

namespace App\Services\AI;

use Illuminate\Support\Facades\Http;
use RuntimeException;

class NexaAiService
{
    protected string $url;

    public function __construct()
    {
        $this->url = rtrim(
            env('NEXA_AI_URL', 'http://127.0.0.1:5001'),
            '/'
        );
    }

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
                'NEXA AI error: ' . $response->body()
            );
        }

        $data = $response->json();

        if (!is_array($data) || !($data['success'] ?? false)) {
            throw new RuntimeException(
                $data['message'] ?? 'Response NEXA AI tidak valid.'
            );
        }

        return $data;
    }

    public function analyzeFile(
        string $filePath,
        string $instruction
    ): array {
        if (!file_exists($filePath)) {
            throw new RuntimeException(
                'File tugas tidak ditemukan: ' . $filePath
            );
        }

        $response = Http::timeout(180)
            ->connectTimeout(10)
            ->post($this->url . '/analyze-file', [
                'file_path' => $filePath,
                'instruction' => $instruction,
            ]);

        if (!$response->successful()) {
            throw new RuntimeException(
                'NEXA AI File error: ' . $response->body()
            );
        }

        $data = $response->json();

        if (!is_array($data) || !($data['success'] ?? false)) {
            throw new RuntimeException(
                $data['message'] ?? 'Response file NEXA AI tidak valid.'
            );
        }

        return $data;
    }

    public function chat(
        string $instruction,
        string $message
    ): array {
        $response = Http::timeout(120)
            ->connectTimeout(10)
            ->post($this->url . '/chat', [
                'instruction' => $instruction,
                'message' => $message,
            ]);

        if (!$response->successful()) {
            throw new RuntimeException(
                'NEXA AI Chat error: ' . $response->body()
            );
        }

        $data = $response->json();

        if (!is_array($data) || !($data['success'] ?? false)) {
            throw new RuntimeException(
                $data['message'] ?? 'Response chat NEXA AI tidak valid.'
            );
        }

        return $data;
    }
}