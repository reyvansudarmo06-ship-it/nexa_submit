<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use RuntimeException;

class OpenAIService
{
    public function generate(
        string $prompt,
        bool $webSearch = false
    ): string {
        $apiKey = config('services.openai.key');
        $model = config('services.openai.model', 'gpt-5.6-luna');

        if (!$apiKey) {
            throw new RuntimeException(
                'OPENAI_API_KEY belum dikonfigurasi.'
            );
        }

        $payload = [
            'model' => $model,
            'input' => $prompt,
        ];

        if ($webSearch) {
            $payload['tools'] = [
                [
                    'type' => 'web_search',
                ],
            ];
        }

        $response = Http::timeout(120)
            ->withToken($apiKey)
            ->acceptJson()
            ->post(
                'https://api.openai.com/v1/responses',
                $payload
            );

        if ($response->failed()) {
            throw new RuntimeException(
                'OpenAI API Error: ' . $response->body()
            );
        }

        $data = $response->json();

        if (!empty($data['output_text'])) {
            return $data['output_text'];
        }

        $text = '';

        foreach ($data['output'] ?? [] as $output) {
            foreach ($output['content'] ?? [] as $content) {
                if (
                    ($content['type'] ?? null) === 'output_text'
                    && isset($content['text'])
                ) {
                    $text .= $content['text'];
                }
            }
        }

        if ($text !== '') {
            return $text;
        }

        throw new RuntimeException(
            'OpenAI tidak memberikan jawaban.'
        );
    }
}