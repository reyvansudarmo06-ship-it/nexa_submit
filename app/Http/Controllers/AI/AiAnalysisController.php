<?php

namespace App\Http\Controllers\AI;

use App\Http\Controllers\Controller;
use App\Models\AiAnalysis;
use App\Models\Notification;
use App\Models\Submission;
use App\Models\SubmissionVersion;
use App\Models\SubmissionVersionAiAnalysis;
use App\Services\AI\NexaAiService;
use App\Services\SystemLogService;
use Illuminate\Support\Facades\Storage;

class AiAnalysisController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | ANALISIS SUBMISSION UTAMA
    |--------------------------------------------------------------------------
    |
    | NEXA AI LOCAL
    |
    | Laravel
    |    ↓
    | NexaAiService
    |    ↓
    | http://127.0.0.1:5001/analyze-file
    |    ↓
    | Python parser
    |    ↓
    | nexa_model.pkl
    |
    */

    public function analyze(
        Submission $submission,
        NexaAiService $nexaAi
    ) {
        $submission->load([
            'student',
            'assignment',
        ]);

        $user = auth()->user();

        /*
        |--------------------------------------------------------------------------
        | CEK AKSES
        |--------------------------------------------------------------------------
        */

        if (
            $user &&
            $user->role === 'student' &&
            (int) $submission->student_id !== (int) $user->id
        ) {
            abort(403);
        }

        /*
        |--------------------------------------------------------------------------
        | CEK FILE
        |--------------------------------------------------------------------------
        */

        if (!$submission->file_path) {
            return response()->json([
                'success' => false,
                'message' => 'File submission tidak ditemukan.',
            ], 422);
        }

        if (!Storage::disk('local')->exists($submission->file_path)) {
            return response()->json([
                'success' => false,
                'message' => 'File submission tidak tersedia di server.',
            ], 404);
        }

        /*
        |--------------------------------------------------------------------------
        | PATH FILE
        |--------------------------------------------------------------------------
        */

        $fullPath = Storage::disk('local')
            ->path($submission->file_path);

        /*
        |--------------------------------------------------------------------------
        | INSTRUKSI TUGAS
        |--------------------------------------------------------------------------
        */

        $instruction = trim(
            (string) (
                $submission->assignment->description
                ?? ''
            )
        );

        if ($instruction === '') {
            $instruction =
                'Analisis tugas siswa berdasarkan isi file yang dikumpulkan. '
                . 'Nilai kesesuaian, kelengkapan, kualitas, dan kerapihan '
                . 'berdasarkan bukti yang tersedia.';
        }

        /*
        |--------------------------------------------------------------------------
        | DEADLINE
        |--------------------------------------------------------------------------
        */

        $deadlineStatus = 'Tidak ada deadline.';
        $deadlineScore = 10;

        if ($submission->assignment->deadline) {

            $deadline = $submission->assignment->deadline;

            if (
                $submission->created_at &&
                $submission->created_at->lte($deadline)
            ) {
                $deadlineStatus =
                    'Dikumpulkan sebelum atau tepat pada deadline.';

                $deadlineScore = 10;
            } else {
                $deadlineStatus =
                    'Dikumpulkan setelah deadline.';

                $deadlineScore = 0;
            }
        }

        /*
        |--------------------------------------------------------------------------
        | ANALISIS NEXA AI LOKAL
        |--------------------------------------------------------------------------
        */

        try {

            $result = $nexaAi->analyzeFile(
                $fullPath,
                $instruction
            );

        } catch (\Throwable $e) {

            \Log::error(
                'NEXA LOCAL AI ANALYSIS ERROR',
                [
                    'submission_id' => $submission->id,
                    'file' => $submission->file_name,
                    'error' => $e->getMessage(),
                ]
            );

            SystemLogService::log(
                'AI_ANALYSIS_FAILED',
                'NEXA AI lokal gagal menganalisis submission: '
                . $submission->file_name
                . ' | Error: '
                . $e->getMessage()
            );

            return response()->json([
                'success' => false,
                'message' =>
                    'NEXA AI lokal tidak dapat menganalisis file saat ini.',
                'error' => $e->getMessage(),
            ], 500);
        }

        /*
        |--------------------------------------------------------------------------
        | AMBIL SCORE DARI NEXA AI
        |--------------------------------------------------------------------------
        */

        $scores = $result['scores'] ?? [];

        $instructionScore = (float) (
            $scores['instruction'] ?? 0
        );

        $completenessScore = (float) (
            $scores['completeness'] ?? 0
        );

        $qualityScore = (float) (
            $scores['quality'] ?? 0
        );

        $neatnessScore = (float) (
            $scores['neatness'] ?? 0
        );

        /*
        |--------------------------------------------------------------------------
        | NORMALISASI SCORE
        |--------------------------------------------------------------------------
        */

        $instructionScore = max(
            0,
            min(100, $instructionScore)
        );

        $completenessScore = max(
            0,
            min(100, $completenessScore)
        );

        $qualityScore = max(
            0,
            min(100, $qualityScore)
        );

        $neatnessScore = max(
            0,
            min(100, $neatnessScore)
        );

        /*
        |--------------------------------------------------------------------------
        | OVERALL NEXA AI
        |--------------------------------------------------------------------------
        */

        $aiOverall = round(
            (
                $instructionScore
                + $completenessScore
                + $qualityScore
                + $neatnessScore
            ) / 4,
            2
        );

        /*
        |--------------------------------------------------------------------------
        | NILAI FINAL
        |--------------------------------------------------------------------------
        |
        | NEXA AI menghasilkan nilai 0-100.
        | Deadline dihitung Laravel.
        |
        */

        $finalScore = round(
            (
                ($instructionScore * 0.30)
                + ($completenessScore * 0.25)
                + ($qualityScore * 0.25)
                + ($neatnessScore * 0.10)
                + ($deadlineScore * 10)
            ),
            2
        );

        /*
        |--------------------------------------------------------------------------
        | DATA HASIL AI
        |--------------------------------------------------------------------------
        */

        $analysisData = [
            'summary' =>
                $result['content_preview']
                ?? 'NEXA AI berhasil menganalisis file.',

            'instruction_match' =>
                $result['strengths']
                ?? [],

            'strengths' =>
                $result['strengths']
                ?? [],

            'weaknesses' =>
                $result['weaknesses']
                ?? [],

            'suggestions' =>
                $result['suggestions']
                ?? [],

            'instruction_score' =>
                $instructionScore,

            'completeness_score' =>
                $completenessScore,

            'quality_score' =>
                $qualityScore,

            'neatness_score' =>
                $neatnessScore,

            'ai_overall_score' =>
                $aiOverall,

            'deadline_status' =>
                $deadlineStatus,

            'deadline_score' =>
                $deadlineScore,

            'overall_score' =>
                $finalScore,

            'engine' =>
                'NEXA AI Local',
        ];

        /*
        |--------------------------------------------------------------------------
        | SIMPAN AI ANALYSIS
        |--------------------------------------------------------------------------
        */

        $analysis = AiAnalysis::updateOrCreate(
            [
                'submission_id' =>
                    $submission->id,
            ],
            [
                'summary' =>
                    is_array($analysisData['summary'])
                    ? json_encode(
                        $analysisData['summary'],
                        JSON_UNESCAPED_UNICODE
                    )
                    : $analysisData['summary'],

                'instruction_match' =>
                    json_encode(
                        $analysisData['instruction_match'],
                        JSON_UNESCAPED_UNICODE
                    ),

                'strengths' =>
                    json_encode(
                        $analysisData['strengths'],
                        JSON_UNESCAPED_UNICODE
                    ),

                'weaknesses' =>
                    json_encode(
                        $analysisData['weaknesses'],
                        JSON_UNESCAPED_UNICODE
                    ),

                'suggestions' =>
                    json_encode(
                        $analysisData['suggestions'],
                        JSON_UNESCAPED_UNICODE
                    ),

                'instruction_score' =>
                    $instructionScore,

                'completeness_score' =>
                    $completenessScore,

                'quality_score' =>
                    $qualityScore,

                'neatness_score' =>
                    $neatnessScore,

                'overall_score' =>
                    $finalScore,

                'deadline_status' =>
                    $deadlineStatus,
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | SYSTEM LOG
        |--------------------------------------------------------------------------
        */

        SystemLogService::log(
            'AI_ANALYSIS_COMPLETED',
            'NEXA AI lokal berhasil menganalisis submission: '
            . $submission->file_name
        );

        /*
        |--------------------------------------------------------------------------
        | RESPONSE
        |--------------------------------------------------------------------------
        */

        return response()->json([
            'success' => true,

            'engine' => 'NEXA AI Local',

            'submission_id' =>
                $submission->id,

            'scores' => [
                'instruction' =>
                    $instructionScore,

                'completeness' =>
                    $completenessScore,

                'quality' =>
                    $qualityScore,

                'neatness' =>
                    $neatnessScore,

                'ai_overall' =>
                    $aiOverall,

                'deadline' =>
                    $deadlineScore,

                'overall' =>
                    $finalScore,
            ],

            'deadline_status' =>
                $deadlineStatus,

            'strengths' =>
                $analysisData['strengths'],

            'weaknesses' =>
                $analysisData['weaknesses'],

            'suggestions' =>
                $analysisData['suggestions'],

            'analysis' =>
                $analysis,
        ]);
    }
}