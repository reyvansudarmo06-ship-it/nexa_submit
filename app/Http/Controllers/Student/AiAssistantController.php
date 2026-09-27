<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\AiConversation;
use App\Models\Assignment;
use App\Services\GeminiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Throwable;

class AiAssistantController extends Controller
{
    public function index()
    {
        $assignments = Assignment::where('status', 'active')
            ->orderBy('deadline', 'asc')
            ->get();

        $conversations = AiConversation::where(
            'user_id',
            auth()->id()
        )
            ->latest()
            ->take(30)
            ->get()
            ->reverse();

        return view(
            'student.ai-assistant',
            compact(
                'assignments',
                'conversations'
            )
        );
    }


    public function ask(
        Request $request,
        GeminiService $gemini
    ) {
        /*
        |--------------------------------------------------------------------------
        | BATAS WAKTU PHP
        |--------------------------------------------------------------------------
        |
        | Gemini kadang membutuhkan waktu lebih dari 60 detik.
        | Naikkan batas controller menjadi 180 detik.
        |
        */

        set_time_limit(180);


        $validated = $request->validate([
            'message' => 'required|string|max:4000',
            'assignment_id' => 'nullable|exists:assignments,id',
        ]);


        try {

            /*
            |--------------------------------------------------------------------------
            | AMBIL TUGAS
            |--------------------------------------------------------------------------
            */

            $assignment = null;

            if (!empty($validated['assignment_id'])) {

                $assignment = Assignment::where(
                    'id',
                    $validated['assignment_id']
                )
                    ->where('status', 'active')
                    ->first();

                if (!$assignment) {

                    $message =
                        'Tugas yang dipilih tidak tersedia.';

                    if ($request->expectsJson()) {

                        return response()->json([
                            'success' => false,
                            'message' => $message,
                        ], 422);
                    }

                    return back()->withErrors([
                        'message' => $message,
                    ]);
                }
            }


            /*
            |--------------------------------------------------------------------------
            | KONTEKS TUGAS
            |--------------------------------------------------------------------------
            */

            $assignmentContext =
                'Tidak ada tugas spesifik yang dipilih.';

            if ($assignment) {

                $assignmentContext = <<<CONTEXT
Judul tugas:
{$assignment->title}

Mata pelajaran:
{$assignment->subject}

Kelas:
{$assignment->class_name}

Instruksi guru:
{$assignment->description}

Deadline:
{$assignment->deadline?->format('d M Y, H:i')}
CONTEXT;
            }


            /*
            |--------------------------------------------------------------------------
            | PROMPT NEXA AI
            |--------------------------------------------------------------------------
            */

            $prompt = <<<PROMPT
Kamu adalah NEXA AI Assistant di aplikasi NEXA SUBMIT.

Kamu membantu siswa memahami tugas sekolah, merencanakan pengerjaan,
memeriksa pemahaman instruksi, dan memberikan arahan belajar.

Kamu BUKAN mesin untuk mengerjakan tugas siswa secara langsung.

Konteks tugas:

{$assignmentContext}

Pertanyaan siswa:

{$validated['message']}

Aturan:
- Jawab dalam bahasa Indonesia yang natural dan mudah dipahami siswa.
- Gunakan konteks tugas jika tersedia.
- Jangan mengarang informasi yang tidak ada.
- Jika pertanyaan berkaitan dengan instruksi tugas, jelaskan berdasarkan instruksi guru.
- Jangan mengklaim sesuatu terdapat dalam tugas jika memang tidak tertulis.
- Boleh memberikan penjelasan, contoh konsep, langkah belajar, dan saran pengerjaan.
- Jangan memberikan jawaban siap-kumpul untuk tugas sekolah.
- Jika siswa meminta kamu mengerjakan seluruh tugas, bantu dengan penjelasan dan langkah pengerjaan, bukan menggantikan siswa.
- Jika konteks tugas tidak tersedia atau informasinya kurang, katakan dengan jujur.
- Jawaban harus ringkas tetapi tetap membantu.
PROMPT;


            /*
            |--------------------------------------------------------------------------
            | PANGGIL GEMINI
            |--------------------------------------------------------------------------
            */

            $response = $gemini->generate($prompt);


            /*
            |--------------------------------------------------------------------------
            | SIMPAN PERCAKAPAN
            |--------------------------------------------------------------------------
            */

            $conversation = AiConversation::create([
                'user_id' =>
                    auth()->id(),

                'assignment_id' =>
                    $assignment?->id,

                'message' =>
                    $validated['message'],

                'response' =>
                    $response,

                'status' =>
                    'completed',
            ]);


            /*
            |--------------------------------------------------------------------------
            | AJAX / FETCH
            |--------------------------------------------------------------------------
            */

            if ($request->expectsJson()) {

                return response()->json([
                    'success' => true,

                    'conversation' => [
                        'id' =>
                            $conversation->id,

                        'message' =>
                            $conversation->message,

                        'response' =>
                            $conversation->response,

                        'created_at' =>
                            $conversation->created_at
                                ->format('H:i'),
                    ],
                ]);
            }


            /*
            |--------------------------------------------------------------------------
            | REQUEST BIASA
            |--------------------------------------------------------------------------
            */

            return redirect()
                ->route('student.ai-assistant')
                ->with(
                    'ai_response',
                    $response
                );


        } catch (Throwable $e) {

            Log::error(
                'NEXA AI Assistant Error',
                [
                    'user_id' =>
                        auth()->id(),

                    'error' =>
                        $e->getMessage(),
                ]
            );


            /*
            |--------------------------------------------------------------------------
            | ERROR AJAX
            |--------------------------------------------------------------------------
            */

            if ($request->expectsJson()) {

                return response()->json([
                    'success' => false,

                    'message' =>
                        'NEXA AI sedang mengalami masalah. Silakan coba lagi.',
                ], 500);
            }


            /*
            |--------------------------------------------------------------------------
            | ERROR REQUEST BIASA
            |--------------------------------------------------------------------------
            */

            return back()
                ->withErrors([
                    'message' =>
                        'NEXA AI sedang mengalami masalah. Silakan coba lagi.',
                ])
                ->withInput();
        }
    }
}