<?php

namespace App\Services;

use RuntimeException;

class NexaAIService
{
    protected GeminiService $gemini;

    public function __construct(GeminiService $gemini)
    {
        $this->gemini = $gemini;
    }

    public function generate(
        string $prompt,
        bool $webSearch = false
    ): string {
        try {
            return $this->gemini->generate($prompt);

        } catch (\Throwable $e) {

            \Log::warning('NEXA AI Provider Error', [
                'provider' => 'gemini',
                'web_search' => $webSearch,
                'error' => $e->getMessage(),
            ]);

            throw new RuntimeException(
                'Provider AI NEXA sedang tidak tersedia: '
                . $e->getMessage()
            );
        }
    }
}