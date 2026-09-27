<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\Submission;
use App\Models\TeacherReview;
use App\Services\SystemLogService;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request, Submission $submission)
    {
        $submission->load('assignment');

        // Pastikan guru hanya bisa menilai tugas miliknya
        if ((int) $submission->assignment->teacher_id !== (int) auth()->id()) {
            abort(
                403,
                'Kamu tidak memiliki akses untuk menilai submission ini.'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | KUNCI PENILAIAN
        |--------------------------------------------------------------------------
        | Kalau submission ini sudah pernah dinilai, jangan izinkan
        | penilaian dibuat ulang atau diubah.
        */

        $existingReview = TeacherReview::where(
            'submission_id',
            $submission->id
        )->first();

        if ($existingReview) {
            return back()->with(
                'error',
                'Penilaian sudah disimpan dan dikunci. Nilai tidak dapat diubah lagi.'
            );
        }

        // Validasi nilai pertama
        $validated = $request->validate([
            'score' => [
                'required',
                'integer',
                'min:0',
                'max:100',
            ],

            'comment' => [
                'nullable',
                'string',
                'max:5000',
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | SIMPAN PENILAIAN PERTAMA
        |--------------------------------------------------------------------------
        */

        TeacherReview::create([
            'submission_id' => $submission->id,
            'teacher_id' => auth()->id(),
            'score' => $validated['score'],
            'comment' => $validated['comment'] ?? null,
            'status' => 'reviewed',
        ]);

        /*
        |--------------------------------------------------------------------------
        | SYSTEM LOG
        |--------------------------------------------------------------------------
        */

        SystemLogService::log(
            'TEACHER_REVIEW',
            'Guru memberikan review untuk tugas: ' .
            $submission->file_name .
            ' dengan nilai ' .
            $validated['score']
        );

        /*
        |--------------------------------------------------------------------------
        | NOTIFIKASI SISWA
        |--------------------------------------------------------------------------
        */

        Notification::create([
            'user_id' => $submission->student_id,

            'type' => 'teacher_review_completed',

            'title' => 'Tugas Dinilai',

            'message' =>
                'Tugas "' .
                $submission->assignment->title .
                '" sudah dinilai oleh guru. Nilai: ' .
                $validated['score'] .
                '/100.',

            'icon' => '📝',

            'action_url' =>
                route(
                    'student.assignments.show',
                    $submission->assignment
                ),

            'read_at' => null,
        ]);

        return back()->with(
            'success',
            'Penilaian guru berhasil disimpan dan sekarang dikunci.'
        );
    }
}