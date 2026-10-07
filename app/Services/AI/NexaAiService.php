<?php

namespace App\Services\AI;

use Illuminate\Support\Facades\Http;
use RuntimeException;

class NexaAiService
{
    protected string $url = 'http://127.0.0.1:5001';

    /*
    |--------------------------------------------------------------------------
    | ANALYZE TEXT
    |--------------------------------------------------------------------------
    */

    public function analyze(
        string $instruction,
        string $answer
    ): array {
        $response = Http::timeout(120)
            ->post($this->url . '/analyze', [
                'instruction' => $instruction,
                'answer' => $answer,
            ]);

        if (!$response->successful()) {
            throw new RuntimeException(
                'NEXA AI API Error: ' . $response->body()
            );
        }

        $data = $response->json();

        if (
            !is_array($data) ||
            !($data['success'] ?? false)
        ) {
            throw new RuntimeException(
                'NEXA AI menghasilkan response tidak valid.'
            );
        }

        return $data;
    }

    /*
    |--------------------------------------------------------------------------
    | ANALYZE FILE
    |--------------------------------------------------------------------------
    */

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
            ->post($this->url . '/analyze-file', [
                'file_path' => $filePath,
                'instruction' => $instruction,
            ]);

        if (!$response->successful()) {
            throw new RuntimeException(
                'NEXA AI File API Error: ' . $response->body()
            );
        }

        $data = $response->json();

        if (
            !is_array($data) ||
            !($data['success'] ?? false)
        ) {
            throw new RuntimeException(
                'NEXA AI menghasilkan response file tidak valid.'
            );
        }

        return $data;
    }
    /*
|--------------------------------------------------------------------------
| CHAT
|--------------------------------------------------------------------------
*/

public function chat(
    string $instruction,
    string $message
): array {
    $response = Http::timeout(120)
        ->post($this->url . '/chat', [
            'instruction' => $instruction,
            'message' => $message,
        ]);

    if (!$response->successful()) {
        throw new RuntimeException(
            'NEXA AI Chat API Error: ' . $response->body()
        );
    }

    $data = $response->json();

    if (
        !is_array($data) ||
        !($data['success'] ?? false)
    ) {
        throw new RuntimeException(
            'NEXA AI menghasilkan response chat tidak valid.'
        );
    }

    return $data;
}
}
