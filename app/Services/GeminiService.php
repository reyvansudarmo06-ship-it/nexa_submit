<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use RuntimeException;

class GeminiService
{
    public function generate(string $prompt): string
    {
        $apiKey = config('services.gemini.key');
        $model = config(
            'services.gemini.model',
            'gemini-3.6-flash'
        );

        if (!$apiKey) {
            throw new RuntimeException(
                'GEMINI_API_KEY belum dikonfigurasi.'
            );
        }

        $url =
            "https://generativelanguage.googleapis.com/v1beta/models/{$model}:generateContent";

        $lastError = null;

        for ($attempt = 1; $attempt <= 3; $attempt++) {

            try {

                $response = Http::timeout(150)
                    ->connectTimeout(20)
                    ->retry(
                        1,
                        1000,
                        throw: false
                    )
                    ->withQueryParameters([
                        'key' => $apiKey,
                    ])
                    ->post($url, [
                        'contents' => [[
                            'parts' => [[
                                'text' => $prompt,
                            ]],
                        ]],
                    ]);


                /*
                |--------------------------------------------------------------------------
                | BERHASIL
                |--------------------------------------------------------------------------
                */

                if ($response->successful()) {

                    return $response->json(
                        'candidates.0.content.parts.0.text',
                        'Gemini tidak memberikan jawaban.'
                    );
                }


                /*
                |--------------------------------------------------------------------------
                | SIMPAN ERROR
                |--------------------------------------------------------------------------
                */

                $lastError =
                    'Gemini API Error: ' .
                    $response->body();


                /*
                |--------------------------------------------------------------------------
                | 503 = MODEL SEDANG PADAT
                |--------------------------------------------------------------------------
                */

                if ($response->status() === 503) {

                    if ($attempt < 3) {

                        sleep(
                            2 * $attempt
                        );

                        continue;
                    }
                }


                /*
                |--------------------------------------------------------------------------
                | 429 = RATE LIMIT
                |--------------------------------------------------------------------------
                */

                if ($response->status() === 429) {

                    if ($attempt < 3) {

                        sleep(
                            3 * $attempt
                        );

                        continue;
                    }
                }


                throw new RuntimeException(
                    $lastError
                );


            } catch (\Throwable $e) {

                $lastError =
                    $e->getMessage();


                /*
                |--------------------------------------------------------------------------
                | COBA LAGI UNTUK ERROR SEMENTARA
                |--------------------------------------------------------------------------
                */

                $temporaryError =
                    str_contains(
                        $lastError,
                        '503'
                    )
                    ||
                    str_contains(
                        $lastError,
                        '429'
                    )
                    ||
                    str_contains(
                        $lastError,
                        'cURL error 28'
                    )
                    ||
                    str_contains(
                        strtolower($lastError),
                        'timed out'
                    );


                if (
                    $temporaryError &&
                    $attempt < 3
                ) {

                    sleep(
                        2 * $attempt
                    );

                    continue;
                }


                throw new RuntimeException(
                    $lastError
                );
            }
        }


        throw new RuntimeException(
            $lastError ??
            'Gemini tidak dapat memberikan jawaban.'
        );
    }


    public function analyzeFile(
        string $filePath,
        string $mimeType,
        string $prompt
    ): string {

        $apiKey =
            config('services.gemini.key');

        $model =
            config(
                'services.gemini.model',
                'gemini-3.6-flash'
            );


        if (!$apiKey) {

            throw new RuntimeException(
                'GEMINI_API_KEY belum dikonfigurasi.'
            );
        }


        if (!file_exists($filePath)) {

            throw new RuntimeException(
                'File tugas tidak ditemukan.'
            );
        }


        $fileData =
            base64_encode(
                file_get_contents($filePath)
            );


        $url =
            "https://generativelanguage.googleapis.com/v1beta/models/{$model}:generateContent";


        $lastError = null;


        for ($attempt = 1; $attempt <= 3; $attempt++) {

            try {

                $response = Http::timeout(150)
                    ->connectTimeout(20)
                    ->retry(
                        1,
                        1000,
                        throw: false
                    )
                    ->withQueryParameters([
                        'key' => $apiKey,
                    ])
                    ->post($url, [

                        'contents' => [[

                            'parts' => [

                                [
                                    'text' =>
                                        $prompt,
                                ],

                                [
                                    'inline_data' => [

                                        'mime_type' =>
                                            $mimeType,

                                        'data' =>
                                            $fileData,
                                    ],
                                ],

                            ],

                        ]],

                    ]);


                if ($response->successful()) {

                    return $response->json(
                        'candidates.0.content.parts.0.text',
                        'Gemini tidak memberikan jawaban.'
                    );
                }


                $lastError =
                    'Gemini File API Error: ' .
                    $response->body();


                if (
                    $response->status() === 503 ||
                    $response->status() === 429
                ) {

                    if ($attempt < 3) {

                        sleep(
                            2 * $attempt
                        );

                        continue;
                    }
                }


                throw new RuntimeException(
                    $lastError
                );


            } catch (\Throwable $e) {

                $lastError =
                    $e->getMessage();


                $temporaryError =
                    str_contains(
                        $lastError,
                        '503'
                    )
                    ||
                    str_contains(
                        $lastError,
                        '429'
                    )
                    ||
                    str_contains(
                        $lastError,
                        'cURL error 28'
                    )
                    ||
                    str_contains(
                        strtolower($lastError),
                        'timed out'
                    );


                if (
                    $temporaryError &&
                    $attempt < 3
                ) {

                    sleep(
                        2 * $attempt
                    );

                    continue;
                }


                throw new RuntimeException(
                    $lastError
                );
            }
        }


        throw new RuntimeException(
            $lastError ??
            'Gemini tidak dapat menganalisis file.'
        );
    }
}