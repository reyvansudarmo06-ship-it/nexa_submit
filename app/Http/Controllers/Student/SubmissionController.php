<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Controllers\AI\AiAnalysisController;
use App\Models\Assignment;
use App\Models\Notification;
use App\Models\Submission;
use App\Services\SystemLogService;
use Illuminate\Http\Request;

class SubmissionController extends Controller
{
    public function create(Assignment $assignment)
    {
        return view(
            'student.submissions.create',
            compact('assignment')
        );
    }

    public function store(
        Request $request,
        Assignment $assignment
    ) {
        $validated = $request->validate([
            'file' => 'required|file|max:10240',
            'note' => 'nullable|string|max:2000',
        ]);

        $studentId = auth()->id();

        /*
        |--------------------------------------------------------------------------
        | CEK SUBMISSION LAMA
        |--------------------------------------------------------------------------
        */

        $existingSubmission = Submission::where(
            'assignment_id',
            $assignment->id
        )
            ->where('student_id', $studentId)
            ->first();

        if ($existingSubmission) {
            return back()->withErrors([
                'file' => 'Kamu sudah mengumpulkan tugas ini.',
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | SIMPAN FILE
        |--------------------------------------------------------------------------
        */

        $file = $request->file('file');

        $path = $file->store('submissions');

        /*
        |--------------------------------------------------------------------------
        | SIMPAN SUBMISSION
        |--------------------------------------------------------------------------
        */

        $submission = Submission::create([
            'assignment_id' => $assignment->id,
            'student_id' => $studentId,
            'file_name' => $file->getClientOriginalName(),
            'file_path' => $path,
            'note' => $validated['note'] ?? null,
            'status' => 'submitted',
        ]);

        /*
        |--------------------------------------------------------------------------
        | SYSTEM LOG
        |--------------------------------------------------------------------------
        */

        SystemLogService::log(
            'SUBMISSION_CREATED',
            'Siswa mengumpulkan tugas: ' .
            $submission->file_name .
            ' untuk tugas: ' .
            $assignment->title
        );

        /*
        |--------------------------------------------------------------------------
        | NOTIFIKASI UNTUK GURU
        |--------------------------------------------------------------------------
        */

        $student = auth()->user();

        Notification::create([
            'user_id' => $assignment->teacher_id,
            'type' => 'submission_created',
            'title' => 'Tugas Dikumpulkan',
            'message' =>
                $student->name .
                ' telah mengumpulkan tugas: ' .
                $assignment->title,
            'icon' => '📥',
            'action_url' => route(
                'teacher.submissions.show',
                $submission
            ),
        ]);

        /*
        |--------------------------------------------------------------------------
        | AUTO ANALISIS NEXA AI
        |--------------------------------------------------------------------------
        |
        | Setelah submission berhasil disimpan, langsung jalankan
        | analisis AI menggunakan controller AI yang sudah ada.
        |
        | Kalau Gemini sedang error / quota habis, submission TETAP
        | dianggap berhasil. Error hanya dicatat ke log.
        |
        */

        try {
            app(AiAnalysisController::class)->analyze($submission);

            SystemLogService::log(
                'AI_AUTO_ANALYSIS',
                'NEXA AI otomatis menganalisis submission: ' .
                $submission->file_name .
                ' untuk tugas: ' .
                $assignment->title
            );
        } catch (\Throwable $e) {
            \Log::warning('NEXA AUTO ANALYSIS FAILED', [
                'submission_id' => $submission->id,
                'assignment_id' => $assignment->id,
                'student_id' => $studentId,
                'error' => $e->getMessage(),
            ]);

            SystemLogService::log(
                'AI_AUTO_ANALYSIS_FAILED',
                'NEXA AI gagal menganalisis submission: ' .
                $submission->file_name .
                ' | Error: ' .
                $e->getMessage()
            );
        }

        /*
        |--------------------------------------------------------------------------
        | REDIRECT
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route(
                'student.assignments.show',
                $assignment
            )
            ->with(
                'success',
                'Tugas berhasil dikumpulkan dan NEXA AI langsung memproses tugasmu.'
            );
    }
}