<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Submission;
use App\Models\SubmissionVersion;
use App\Models\VersionComparison;
use App\Services\GeminiService;
use Illuminate\Http\JsonResponse;
use Throwable;

class VersionComparisonController extends Controller
{
    public function compare(
        Submission $submission,
        SubmissionVersion $fromVersion,
        SubmissionVersion $toVersion,
        GeminiService $gemini
    ): JsonResponse {
        try {

            /*
            |--------------------------------------------------------------------------
            | SECURITY
            |--------------------------------------------------------------------------
            */

            if ($submission->student_id !== auth()->id()) {
                abort(403, 'Akses tidak diizinkan.');
            }

            if (
                $fromVersion->submission_id !== $submission->id ||
                $toVersion->submission_id !== $submission->id
            ) {
                abort(403, 'Version tidak sesuai dengan submission.');
            }

            if ($fromVersion->id === $toVersion->id) {
                return response()->json([
                    'success' => false,
                    'message' => 'Version yang dibandingkan harus berbeda.',
                ], 422);
            }


            /*
            |--------------------------------------------------------------------------
            | LOAD AI ANALYSIS
            |--------------------------------------------------------------------------
            */

            $fromVersion->load('aiAnalysis');

            $toVersion->load('aiAnalysis');

            if (!$fromVersion->aiAnalysis) {
                return response()->json([
                    'success' => false,
                    'message' =>
                        "Version {$fromVersion->version_number} belum dianalisis AI.",
                ], 422);
            }

            if (!$toVersion->aiAnalysis) {
                return response()->json([
                    'success' => false,
                    'message' =>
                        "Version {$toVersion->version_number} belum dianalisis AI.",
                ], 422);
            }


            /*
            |--------------------------------------------------------------------------
            | SCORE
            |--------------------------------------------------------------------------
            */

            $fromScore = $fromVersion->aiAnalysis->score;

            $toScore = $toVersion->aiAnalysis->score;

            $scoreChange = null;

            if (
                $fromScore !== null &&
                $toScore !== null
            ) {
                $scoreChange = $toScore - $fromScore;
            }


            /*
            |--------------------------------------------------------------------------
            | PROMPT GEMINI
            |--------------------------------------------------------------------------
            */

            $prompt = <<<PROMPT
Kamu adalah AI Version Comparison Engine untuk aplikasi NEXA SUBMIT.

Tugas kamu adalah membandingkan hasil evaluasi AI antara dua versi tugas
yang berbeda.

Jangan mengarang informasi.

Gunakan HANYA data evaluasi yang diberikan di bawah.

========================
DATA TUGAS
========================

Judul:
{$submission->assignment?->title}

Mata Pelajaran:
{$submission->assignment?->subject}

Kelas:
{$submission->assignment?->class_name}

Instruksi:
{$submission->assignment?->description}

========================
VERSION LAMA
========================

Version:
{$fromVersion->version_number}

File:
{$fromVersion->file_name}

Score:
{$fromScore}

Ringkasan:
{$fromVersion->aiAnalysis->summary}

Kesesuaian Instruksi:
{$fromVersion->aiAnalysis->instruction_match}

Yang Sudah Baik:
{$fromVersion->aiAnalysis->strengths}

Yang Masih Kurang:
{$fromVersion->aiAnalysis->weaknesses}

Saran:
{$fromVersion->aiAnalysis->suggestions}

Kelengkapan:
{$fromVersion->aiAnalysis->completeness}

Kualitas:
{$fromVersion->aiAnalysis->quality}

========================
VERSION BARU
========================

Version:
{$toVersion->version_number}

File:
{$toVersion->file_name}

Score:
{$toScore}

Ringkasan:
{$toVersion->aiAnalysis->summary}

Kesesuaian Instruksi:
{$toVersion->aiAnalysis->instruction_match}

Yang Sudah Baik:
{$toVersion->aiAnalysis->strengths}

Yang Masih Kurang:
{$toVersion->aiAnalysis->weaknesses}

Saran:
{$toVersion->aiAnalysis->suggestions}

Kelengkapan:
{$toVersion->aiAnalysis->completeness}

Kualitas:
{$toVersion->aiAnalysis->quality}

========================
TUGAS AI
========================

Bandingkan Version Lama dan Version Baru.

Analisis:

1. Apakah kualitas tugas mengalami perkembangan?
2. Apa saja bagian yang membaik?
3. Apa saja masalah yang masih tersisa?
4. Apakah kesesuaian dengan instruksi meningkat?
5. Apa rekomendasi untuk versi berikutnya?

Jangan hanya melihat perubahan angka score.

Gunakan isi evaluasi untuk menjelaskan perubahan.

========================
FORMAT OUTPUT
========================

WAJIB mengembalikan JSON VALID.

Jangan gunakan markdown.

Jangan gunakan tanda ```.

Gunakan struktur PERSIS berikut:

{
    "improvement_summary": "Ringkasan perkembangan dari versi lama ke versi baru.",
    "improved_areas": "Bagian-bagian yang mengalami peningkatan.",
    "remaining_issues": "Masalah yang masih tersisa pada versi baru.",
    "ai_recommendation": "Rekomendasi AI untuk versi berikutnya."
}

Jika tidak ada perkembangan yang jelas,
katakan berdasarkan data bahwa peningkatan belum dapat diverifikasi.

Jangan mengarang perubahan yang tidak didukung data.
PROMPT;


            /*
            |--------------------------------------------------------------------------
            | CALL GEMINI
            |--------------------------------------------------------------------------
            */

            $result = $gemini->generate($prompt);

            $result = trim($result);

            $result = preg_replace(
                '/^```json\s*/i',
                '',
                $result
            );

            $result = preg_replace(
                '/\s*```$/',
                '',
                $result
            );

            $result = trim($result);

            $analysis = json_decode(
                $result,
                true
            );


            /*
            |--------------------------------------------------------------------------
            | VALIDATE GEMINI RESPONSE
            |--------------------------------------------------------------------------
            */

            if (!is_array($analysis)) {
                return response()->json([
                    'success' => false,
                    'message' =>
                        'Gemini mengembalikan JSON yang tidak valid.',
                    'raw' => $result,
                ], 422);
            }


            /*
            |--------------------------------------------------------------------------
            | SAVE COMPARISON
            |--------------------------------------------------------------------------
            */

            $comparison = VersionComparison::updateOrCreate(
                [
                    'from_version_id' => $fromVersion->id,
                    'to_version_id' => $toVersion->id,
                ],
                [
                    'submission_id' => $submission->id,

                    'from_score' => $fromScore,

                    'to_score' => $toScore,

                    'score_change' => $scoreChange,

                    'improvement_summary' =>
                        $analysis['improvement_summary'] ?? null,

                    'improved_areas' =>
                        $analysis['improved_areas'] ?? null,

                    'remaining_issues' =>
                        $analysis['remaining_issues'] ?? null,

                    'ai_recommendation' =>
                        $analysis['ai_recommendation'] ?? null,

                    'status' => 'completed',
                ]
            );


            /*
            |--------------------------------------------------------------------------
            | RESPONSE
            |--------------------------------------------------------------------------
            */

            return response()->json([
                'success' => true,

                'message' =>
                    "Perbandingan Version {$fromVersion->version_number} → Version {$toVersion->version_number} berhasil.",

                'comparison' => $comparison,

                'from_version' => [
                    'id' => $fromVersion->id,
                    'version_number' =>
                        $fromVersion->version_number,
                    'score' => $fromScore,
                ],

                'to_version' => [
                    'id' => $toVersion->id,
                    'version_number' =>
                        $toVersion->version_number,
                    'score' => $toScore,
                ],
            ]);

        } catch (Throwable $e) {

            return response()->json([
                'success' => false,

                'message' =>
                    'Terjadi kesalahan saat membandingkan version.',

                'error' => $e->getMessage(),

                'file' => $e->getFile(),

                'line' => $e->getLine(),
            ], 500);
        }
    }
}