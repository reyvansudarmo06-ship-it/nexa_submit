<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\AiInstructionAnalysis;
use App\Services\GeminiService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Throwable;

class AiInstructionController extends Controller
{
    public function index()
    {
        $assignments = Assignment::where('status', 'active')
            ->with('aiInstructionAnalysis')
            ->orderBy('deadline', 'asc')
            ->get();

        return view(
            'student.ai-instruction',
            compact('assignments')
        );
    }

    public function analyze(
        Assignment $assignment,
        GeminiService $gemini
    ): JsonResponse {

        if ($assignment->status !== 'active') {
            return response()->json([
                'success' => false,
                'message' => 'Tugas ini sudah tidak aktif.',
            ], 422);
        }

        try {

            $prompt = <<<PROMPT
Kamu adalah NEXA AI, asisten pembelajaran untuk aplikasi NEXA SUBMIT.

Tugas berikut diberikan oleh guru:

Judul:
{$assignment->title}

Mata Pelajaran:
{$assignment->subject}

Kelas:
{$assignment->class_name}

Instruksi / Deskripsi:
{$assignment->description}

Deadline:
{$assignment->deadline?->format('d M Y, H:i')}

Baca instruksi tugas tersebut dengan teliti.

Tujuan kamu adalah membantu siswa memahami tugas tanpa mengerjakan tugasnya.

Kembalikan HANYA JSON valid dengan struktur berikut:

{
    "summary": "ringkasan singkat instruksi tugas",
    "objective": "tujuan utama tugas",
    "requirements": "hal-hal yang wajib dibuat atau dipenuhi siswa",
    "checklist": [
        "item checklist 1",
        "item checklist 2",
        "item checklist 3"
    ],
    "important_notes": "hal penting yang harus diperhatikan siswa",
    "step_by_step": [
        "langkah 1",
        "langkah 2",
        "langkah 3"
    ]
}

Aturan:
- Jangan mengarang informasi yang tidak terdapat dalam instruksi.
- Jika informasi tidak disebutkan, tuliskan bahwa informasi tersebut tidak dijelaskan.
- Gunakan bahasa Indonesia yang mudah dipahami siswa.
- Jangan mengerjakan tugas siswa.
- Jangan memberikan jawaban tugas.
- Fokus hanya membantu memahami instruksi.
PROMPT;

            $result = $gemini->generate($prompt);

            $cleanJson = trim($result);

            $cleanJson = preg_replace(
                '/^```json\s*/i',
                '',
                $cleanJson
            );

            $cleanJson = preg_replace(
                '/\s*```$/',
                '',
                $cleanJson
            );

            $analysis = json_decode(
                $cleanJson,
                true
            );

            if (
                !is_array($analysis)
                || json_last_error() !== JSON_ERROR_NONE
            ) {
                throw new \RuntimeException(
                    'Response NEXA AI bukan JSON yang valid.'
                );
            }

            $checklist = $analysis['checklist'] ?? [];

            if (!is_array($checklist)) {
                $checklist = [$checklist];
            }

            $stepByStep = $analysis['step_by_step'] ?? [];

            if (!is_array($stepByStep)) {
                $stepByStep = [$stepByStep];
            }

            $saved = AiInstructionAnalysis::updateOrCreate(
                [
                    'assignment_id' => $assignment->id,
                ],
                [
                    'summary' => $analysis['summary'] ?? null,

                    'objective' => $analysis['objective'] ?? null,

                    'requirements' => $analysis['requirements'] ?? null,

                    'checklist' => json_encode(
                        $checklist,
                        JSON_UNESCAPED_UNICODE
                    ),

                    'important_notes' =>
                        $analysis['important_notes'] ?? null,

                    'step_by_step' => json_encode(
                        $stepByStep,
                        JSON_UNESCAPED_UNICODE
                    ),

                    'status' => 'completed',
                ]
            );

            return response()->json([
                'success' => true,
                'message' =>
                    'Instruksi berhasil dianalisis oleh NEXA AI.',
                'analysis' => $saved,
            ]);

        } catch (Throwable $e) {

            Log::error(
                'NEXA AI Instruction Analysis Error',
                [
                    'assignment_id' => $assignment->id,
                    'error' => $e->getMessage(),
                ]
            );

            return response()->json([
                'success' => false,
                'message' =>
                    'NEXA AI gagal menganalisis instruksi.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}