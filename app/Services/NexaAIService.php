<?php

namespace App\Services;

use App\Services\AI\NexaAiService;
use RuntimeException;

class NexaAIService
{
    protected NexaAiService $ai;

    public function __construct(NexaAiService $ai)
    {
        $this->ai = $ai;
    }

    public function analyze(
        string $instruction,
        string $answer
    ): array {
        return $this->ai->analyze($instruction, $answer);
    }

    public function generate(
        string $prompt,
        bool $webSearch = false
    ): string {
        $instruction = 'Bantu siswa mengerjakan tugas dengan jelas dan langsung. '
            . 'Gunakan bahasa Indonesia. ';

        if ($webSearch) {
            $instruction .= 'Jangan mengarang hasil pencarian web atau mengaku sudah melakukan pencarian.';
        }

        $result = $this->ai->chat($instruction, $prompt);
        $response = trim($result['response'] ?? '');

        if (!($result['success'] ?? false) || $response === '') {
            throw new RuntimeException(
                'NEXA AI tidak memberikan jawaban.'
            );
        }

        return $response;
    }
}