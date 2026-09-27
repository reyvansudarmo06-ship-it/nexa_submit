<?php

namespace App\Http\Controllers\AI;

use App\Http\Controllers\Controller;
use App\Models\AiAnalysis;
use App\Models\Notification;
use App\Models\Submission;
use App\Models\SubmissionVersion;
use App\Models\SubmissionVersionAiAnalysis;
use App\Services\GeminiService;
use App\Services\SystemLogService;
use Illuminate\Support\Facades\Storage;

class AiAnalysisController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | ANALISIS SUBMISSION UTAMA
    |--------------------------------------------------------------------------
    |
    | Rubrik NEXA AI:
    |
    | Instruction Match = 30
    | Completeness      = 25
    | Quality           = 25
    | Neatness          = 10
    | Deadline          = 10
    |
    | Total              = 100
    |
    */

    public function analyze(
        Submission $submission,
        GeminiService $gemini
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
        | INFORMASI FILE
        |--------------------------------------------------------------------------
        */

        $fullPath = Storage::disk('local')
            ->path($submission->file_path);

        $mimeType = mime_content_type($fullPath);

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
        | PROMPT NEXA AI
        |--------------------------------------------------------------------------
        */

        $prompt = <<<PROMPT
Kamu adalah NEXA AI, sistem evaluasi tugas siswa.

Analisis file tugas siswa berdasarkan informasi berikut.

JUDUL TUGAS:
{$submission->assignment->title}

MATA PELAJARAN:
{$submission->assignment->subject}

KELAS:
{$submission->assignment->class_name}

INSTRUKSI TUGAS:
{$submission->assignment->description}

NAMA SISWA:
{$submission->student->name}

CATATAN SISWA:
{$submission->note}

DEADLINE:
{$submission->assignment->deadline}

TANGGAL PENGUMPULAN:
{$submission->created_at}

FILE:
{$submission->file_name}

JENIS FILE:
{$mimeType}

==================================================
RUBRIK PENILAIAN
==================================================

1. INSTRUCTION MATCH
Bobot maksimal: 30 poin.

Nilai berdasarkan seberapa sesuai isi file dengan instruksi tugas.

2. COMPLETENESS
Bobot maksimal: 25 poin.

Nilai berdasarkan kelengkapan bagian, isi, data, jawaban,
atau komponen yang diminta.

3. QUALITY
Bobot maksimal: 25 poin.

Nilai berdasarkan kualitas isi, ketepatan, kedalaman,
relevansi, dan hasil pengerjaan.

4. NEATNESS
Bobot maksimal: 10 poin.

Nilai berdasarkan kerapihan, struktur, format,
keterbacaan, dan organisasi file.

5. DEADLINE
Bobot maksimal: 10 poin.

Deadline TIDAK boleh dihitung oleh AI.

Nilai deadline akan dihitung oleh sistem Laravel.

==================================================
ATURAN PENILAIAN WAJIB
==================================================

Kamu WAJIB memberikan nilai numerik untuk keempat komponen berikut:

instruction_score:
0 sampai 30

completeness_score:
0 sampai 25

quality_score:
0 sampai 25

neatness_score:
0 sampai 10

JANGAN memberikan nilai akhir.

Nilai akhir akan dihitung oleh Laravel.

JANGAN mengisi semua nilai dengan 0 hanya karena instruksi
tugas tidak jelas.

Jika instruksi tugas kosong atau tidak jelas:

- instruction_score boleh 0 karena kesesuaian instruksi
  tidak dapat diverifikasi.

- completeness_score tetap harus menilai kelengkapan
  file berdasarkan isi yang benar-benar terlihat.

- quality_score tetap harus menilai kualitas file berdasarkan
  bukti yang tersedia.

- neatness_score tetap harus menilai kerapihan, struktur,
  format, dan keterbacaan file.

Jika file memiliki isi yang dapat dibaca atau dianalisis,
berikan nilai berdasarkan bukti yang tersedia.

Nilai 0 hanya boleh digunakan apabila memang tidak ada
bukti yang memungkinkan penilaian komponen tersebut.

Contoh:

Jika sebuah file CSV memiliki struktur yang lengkap,
kolom jelas, data terbaca, dan format rapi, maka
completeness_score, quality_score, dan neatness_score
TIDAK BOLEH otomatis menjadi 0 hanya karena instruksi
tugas tidak tersedia.

Jika file bukan hasil pengerjaan tugas melainkan file lain,
jelaskan hal tersebut pada bagian weaknesses dan suggestions,
tetapi tetap nilai kualitas teknis dan kerapihan file
jika bukti memungkinkan.

Jangan mengarang isi file yang tidak terlihat.

Jangan memberikan nilai berdasarkan asumsi.

Gunakan hanya bukti yang tersedia dari file dan informasi tugas.

PASTIKAN keempat field berikut SELALU ada:

instruction_score
completeness_score
quality_score
neatness_score

==================================================
FORMAT OUTPUT
==================================================

Balas HANYA JSON valid.

Gunakan struktur berikut:

{
    "summary": "...",
    "instruction_match": "...",
    "strengths": "...",
    "weaknesses": "...",
    "suggestions": "...",
    "instruction_score": 0,
    "completeness_score": 0,
    "quality_score": 0,
    "neatness_score": 0,
    "completeness": "...",
    "quality": "...",
    "deadline_status": "..."
}

Jangan menggunakan markdown.

Jangan menggunakan ```json.

Jangan menambahkan teks sebelum atau sesudah JSON.

PROMPT;

        /*
        |--------------------------------------------------------------------------
        | PANGGIL GEMINI
        |--------------------------------------------------------------------------
        */

        try {
            $rawResponse = $gemini->analyzeFile(
                $fullPath,
                $mimeType,
                $prompt
            );
        } catch (\Throwable $e) {
            \Log::error('NEXA AI ANALYSIS ERROR', [
                'submission_id' => $submission->id,
                'error' => $e->getMessage(),
            ]);

            SystemLogService::log(
                'AI_ANALYSIS_FAILED',
                'NEXA AI gagal menganalisis submission: ' .
                $submission->file_name .
                ' | Error: ' .
                $e->getMessage()
            );

            return response()->json([
                'success' => false,
                'message' =>
                    'NEXA AI tidak dapat menganalisis file saat ini.',
            ], 500);
        }

        /*
        |--------------------------------------------------------------------------
        | BERSIHKAN RESPONSE
        |--------------------------------------------------------------------------
        */

        $cleanResponse = trim($rawResponse);

        $cleanResponse = preg_replace(
            '/^```json\s*/i',
            '',
            $cleanResponse
        );

        $cleanResponse = preg_replace(
            '/\s*```$/',
            '',
            $cleanResponse
        );

        $cleanResponse = trim($cleanResponse);

        /*
        |--------------------------------------------------------------------------
        | PARSE JSON
        |--------------------------------------------------------------------------
        */

        $analysis = json_decode(
            $cleanResponse,
            true
        );

        if (
            !is_array($analysis) ||
            json_last_error() !== JSON_ERROR_NONE
        ) {
            \Log::error('NEXA AI INVALID JSON', [
                'submission_id' => $submission->id,
                'response' => $rawResponse,
            ]);

            return response()->json([
                'success' => false,
                'message' =>
                    'NEXA AI menghasilkan format data yang tidak valid.',
            ], 500);
        }

        /*
        |--------------------------------------------------------------------------
        | AMBIL NILAI AI
        |--------------------------------------------------------------------------
        */

        $instructionScore = (int) (
            $analysis['instruction_score'] ?? 0
        );

        $completenessScore = (int) (
            $analysis['completeness_score'] ?? 0
        );

        $qualityScore = (int) (
            $analysis['quality_score'] ?? 0
        );

        $neatnessScore = (int) (
            $analysis['neatness_score'] ?? 0
        );

        /*
        |--------------------------------------------------------------------------
        | BATASI NILAI SESUAI BOBOT
        |--------------------------------------------------------------------------
        */

        $instructionScore = max(
            0,
            min(30, $instructionScore)
        );

        $completenessScore = max(
            0,
            min(25, $completenessScore)
        );

        $qualityScore = max(
            0,
            min(25, $qualityScore)
        );

        $neatnessScore = max(
            0,
            min(10, $neatnessScore)
        );

        /*
        |--------------------------------------------------------------------------
        | HITUNG NILAI AKHIR DI LARAVEL
        |--------------------------------------------------------------------------
        */

        $score =
            $instructionScore +
            $completenessScore +
            $qualityScore +
            $neatnessScore +
            $deadlineScore;

        /*
        |--------------------------------------------------------------------------
        | SIMPAN HASIL AI
        |--------------------------------------------------------------------------
        */

        $savedAnalysis = AiAnalysis::updateOrCreate(
            [
                'submission_id' => $submission->id,
            ],
            [
                'summary' =>
                    $analysis['summary'] ?? null,

                'instruction_match' =>
                    $analysis['instruction_match'] ?? null,

                'strengths' =>
                    $analysis['strengths'] ?? null,

                'weaknesses' =>
                    $analysis['weaknesses'] ?? null,

                'suggestions' =>
                    $analysis['suggestions'] ?? null,

                'score' =>
                    $score,

                'instruction_score' =>
                    $instructionScore,

                'completeness_score' =>
                    $completenessScore,

                'quality_score' =>
                    $qualityScore,

                'neatness_score' =>
                    $neatnessScore,

                'deadline_score' =>
                    $deadlineScore,

                'completeness' =>
                    $analysis['completeness'] ?? null,

                'quality' =>
                    $analysis['quality'] ?? null,

                'deadline_status' =>
                    $deadlineStatus,

                'status' =>
                    'completed',
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | LOG
        |--------------------------------------------------------------------------
        */

        SystemLogService::log(
            'AI_ANALYSIS',
            'NEXA AI menganalisis submission: ' .
            $submission->file_name .
            ' | Nilai akhir: ' .
            $score .
            '/100'
        );

        /*
        |--------------------------------------------------------------------------
        | NOTIFIKASI SISWA
        |--------------------------------------------------------------------------
        */

        Notification::create([
            'user_id' => $submission->student_id,
            'type' => 'ai_analysis_completed',
            'title' => 'Analisis AI Selesai',
            'message' =>
                'NEXA AI telah selesai menganalisis tugas "' .
                $submission->assignment->title .
                '". Nilai AI: ' .
                $score .
                '/100.',
            'icon' => '🤖',
            'action_url' =>
                route('student.ai-check'),
        ]);

        /*
        |--------------------------------------------------------------------------
        | RESPONSE
        |--------------------------------------------------------------------------
        */

        return response()->json([
            'success' => true,

            'message' =>
                'NEXA AI berhasil menganalisis tugas.',

            'analysis' => [
                'id' =>
                    $savedAnalysis->id,

                'score' =>
                    $score,

                'instruction_score' =>
                    $instructionScore,

                'completeness_score' =>
                    $completenessScore,

                'quality_score' =>
                    $qualityScore,

                'neatness_score' =>
                    $neatnessScore,

                'deadline_score' =>
                    $deadlineScore,

                'summary' =>
                    $analysis['summary'] ?? null,

                'instruction_match' =>
                    $analysis['instruction_match'] ?? null,

                'strengths' =>
                    $analysis['strengths'] ?? null,

                'weaknesses' =>
                    $analysis['weaknesses'] ?? null,

                'suggestions' =>
                    $analysis['suggestions'] ?? null,

                'completeness' =>
                    $analysis['completeness'] ?? null,

                'quality' =>
                    $analysis['quality'] ?? null,

                'deadline_status' =>
                    $deadlineStatus,
            ],
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | ANALISIS VERSION
    |--------------------------------------------------------------------------
    */

    public function analyzeVersion(
        SubmissionVersion $version,
        GeminiService $gemini
    ) {
        $version->load([
            'submission.student',
            'submission.assignment',
        ]);

        $submission = $version->submission;

        $user = auth()->user();

        /*
        |--------------------------------------------------------------------------
        | CEK AKSES
        |--------------------------------------------------------------------------
        */

        if (
            $user->role === 'student' &&
            (int) $submission->student_id !== (int) $user->id
        ) {
            abort(403);
        }

        /*
        |--------------------------------------------------------------------------
        | FILE
        |--------------------------------------------------------------------------
        */

        if (!$version->file_path) {
            return response()->json([
                'success' => false,
                'message' => 'File version tidak ditemukan.',
            ], 422);
        }

        if (!Storage::disk('local')->exists($version->file_path)) {
            return response()->json([
                'success' => false,
                'message' => 'File version tidak tersedia.',
            ], 404);
        }

        $fullPath = Storage::disk('local')
            ->path($version->file_path);

        $mimeType = mime_content_type($fullPath);

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
                $version->created_at &&
                $version->created_at->lte($deadline)
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
        | PROMPT VERSION
        |--------------------------------------------------------------------------
        */

        $prompt = <<<PROMPT
Kamu adalah NEXA AI, sistem evaluasi tugas siswa.

Analisis file tugas berdasarkan informasi berikut.

JUDUL TUGAS:
{$submission->assignment->title}

MATA PELAJARAN:
{$submission->assignment->subject}

KELAS:
{$submission->assignment->class_name}

INSTRUKSI TUGAS:
{$submission->assignment->description}

NAMA SISWA:
{$submission->student->name}

CATATAN:
{$submission->note}

FILE:
{$version->file_name}

JENIS FILE:
{$mimeType}

==================================================
RUBRIK PENILAIAN
==================================================

Instruction Match = maksimal 30 poin
Completeness = maksimal 25 poin
Quality = maksimal 25 poin
Neatness = maksimal 10 poin
Deadline = maksimal 10 poin

Deadline TIDAK boleh dihitung oleh AI.
Deadline dihitung oleh Laravel.

==================================================
ATURAN PENILAIAN WAJIB
==================================================

Kamu WAJIB memberikan nilai numerik untuk:

instruction_score:
0 sampai 30

completeness_score:
0 sampai 25

quality_score:
0 sampai 25

neatness_score:
0 sampai 10

Jangan memberikan nilai akhir.

Jika instruksi tugas kosong atau tidak jelas:

- instruction_score boleh 0.
- completeness_score tetap harus menilai kelengkapan file.
- quality_score tetap harus menilai kualitas file.
- neatness_score tetap harus menilai kerapihan file.

Jangan mengisi semua nilai dengan 0 hanya karena
instruksi tugas tidak tersedia.

Nilai 0 hanya digunakan jika memang tidak ada bukti
yang memungkinkan penilaian.

Gunakan hanya bukti yang tersedia.

Jangan mengarang isi file.

PASTIKAN semua field berikut ada:

instruction_score
completeness_score
quality_score
neatness_score

==================================================
FORMAT OUTPUT
==================================================

Balas HANYA JSON valid:

{
    "summary": "...",
    "instruction_match": "...",
    "strengths": "...",
    "weaknesses": "...",
    "suggestions": "...",
    "instruction_score": 0,
    "completeness_score": 0,
    "quality_score": 0,
    "neatness_score": 0,
    "completeness": "...",
    "quality": "...",
    "deadline_status": "..."
}

Jangan menggunakan markdown.
Jangan menggunakan ```json.
Jangan menambahkan teks sebelum atau sesudah JSON.

PROMPT;

        /*
        |--------------------------------------------------------------------------
        | GEMINI
        |--------------------------------------------------------------------------
        */

        try {
            $rawResponse = $gemini->analyzeFile(
                $fullPath,
                $mimeType,
                $prompt
            );
        } catch (\Throwable $e) {
            \Log::error(
                'NEXA AI VERSION ANALYSIS ERROR',
                [
                    'version_id' => $version->id,
                    'error' => $e->getMessage(),
                ]
            );

            return response()->json([
                'success' => false,
                'message' =>
                    'NEXA AI tidak dapat menganalisis version ini.',
            ], 500);
        }

        /*
        |--------------------------------------------------------------------------
        | CLEAN JSON
        |--------------------------------------------------------------------------
        */

        $cleanResponse = trim($rawResponse);

        $cleanResponse = preg_replace(
            '/^```json\s*/i',
            '',
            $cleanResponse
        );

        $cleanResponse = preg_replace(
            '/\s*```$/',
            '',
            $cleanResponse
        );

        $cleanResponse = trim($cleanResponse);

        /*
        |--------------------------------------------------------------------------
        | PARSE JSON
        |--------------------------------------------------------------------------
        */

        $analysis = json_decode(
            $cleanResponse,
            true
        );

        if (
            !is_array($analysis) ||
            json_last_error() !== JSON_ERROR_NONE
        ) {
            return response()->json([
                'success' => false,
                'message' =>
                    'Format hasil NEXA AI tidak valid.',
            ], 500);
        }

        /*
        |--------------------------------------------------------------------------
        | SCORE
        |--------------------------------------------------------------------------
        */

        $instructionScore = max(
            0,
            min(
                30,
                (int) ($analysis['instruction_score'] ?? 0)
            )
        );

        $completenessScore = max(
            0,
            min(
                25,
                (int) ($analysis['completeness_score'] ?? 0)
            )
        );

        $qualityScore = max(
            0,
            min(
                25,
                (int) ($analysis['quality_score'] ?? 0)
            )
        );

        $neatnessScore = max(
            0,
            min(
                10,
                (int) ($analysis['neatness_score'] ?? 0)
            )
        );

        /*
        |--------------------------------------------------------------------------
        | NILAI AKHIR
        |--------------------------------------------------------------------------
        */

        $score =
            $instructionScore +
            $completenessScore +
            $qualityScore +
            $neatnessScore +
            $deadlineScore;

        /*
        |--------------------------------------------------------------------------
        | SIMPAN VERSION ANALYSIS
        |--------------------------------------------------------------------------
        */

        $savedAnalysis =
            SubmissionVersionAiAnalysis::updateOrCreate(
                [
                    'submission_version_id' =>
                        $version->id,
                ],
                [
                    'summary' =>
                        $analysis['summary'] ?? null,

                    'instruction_match' =>
                        $analysis['instruction_match'] ?? null,

                    'strengths' =>
                        $analysis['strengths'] ?? null,

                    'weaknesses' =>
                        $analysis['weaknesses'] ?? null,

                    'suggestions' =>
                        $analysis['suggestions'] ?? null,

                    'score' =>
                        $score,

                    'instruction_score' =>
                        $instructionScore,

                    'completeness_score' =>
                        $completenessScore,

                    'quality_score' =>
                        $qualityScore,

                    'neatness_score' =>
                        $neatnessScore,

                    'deadline_score' =>
                        $deadlineScore,

                    'completeness' =>
                        $analysis['completeness'] ?? null,

                    'quality' =>
                        $analysis['quality'] ?? null,

                    'deadline_status' =>
                        $deadlineStatus,

                    'status' =>
                        'completed',
                ]
            );

        /*
        |--------------------------------------------------------------------------
        | LOG
        |--------------------------------------------------------------------------
        */

        SystemLogService::log(
            'AI_VERSION_ANALYSIS',
            'NEXA AI menganalisis version submission: ' .
            $version->file_name .
            ' | Nilai: ' .
            $score .
            '/100'
        );

        /*
        |--------------------------------------------------------------------------
        | RESPONSE
        |--------------------------------------------------------------------------
        */

        return response()->json([
            'success' => true,

            'message' =>
                'NEXA AI berhasil menganalisis version.',

            'analysis' => [
                'id' =>
                    $savedAnalysis->id,

                'score' =>
                    $score,

                'instruction_score' =>
                    $instructionScore,

                'completeness_score' =>
                    $completenessScore,

                'quality_score' =>
                    $qualityScore,

                'neatness_score' =>
                    $neatnessScore,

                'deadline_score' =>
                    $deadlineScore,

                'summary' =>
                    $analysis['summary'] ?? null,

                'instruction_match' =>
                    $analysis['instruction_match'] ?? null,

                'strengths' =>
                    $analysis['strengths'] ?? null,

                'weaknesses' =>
                    $analysis['weaknesses'] ?? null,

                'suggestions' =>
                    $analysis['suggestions'] ?? null,

                'completeness' =>
                    $analysis['completeness'] ?? null,

                'quality' =>
                    $analysis['quality'] ?? null,

                'deadline_status' =>
                    $deadlineStatus,
            ],
        ]);
    }
}