<?php

namespace App\Http\Controllers\AI;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class GeminiTestController extends Controller
{
    public function test()
    {
        $apiKey = config('services.gemini.key');
        $model = config('services.gemini.model', 'gemini-2.5-flash');

        $url = "https://generativelanguage.googleapis.com/v1beta/models/{$model}:generateContent";

        $response = Http::timeout(60)
            ->withQueryParameters([
                'key' => $apiKey,
            ])
            ->post($url, [
                'contents' => [
                    [
                        'parts' => [
                            [
                                'text' => 'Jawab singkat dalam bahasa Indonesia: Apa fungsi utama aplikasi pengumpulan tugas sekolah?',
                            ],
                        ],
                    ],
                ],
            ]);

        if ($response->failed()) {
            return response()->json([
                'success' => false,
                'status' => $response->status(),
                'error' => $response->json(),
            ], $response->status());
        }

        $data = $response->json();

        return response()->json([
            'success' => true,
            'model' => $model,
            'answer' => $data['candidates'][0]['content']['parts'][0]['text']
                ?? 'Tidak ada jawaban dari Gemini.',
        ]);
    }
}