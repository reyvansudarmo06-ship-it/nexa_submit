<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\Submission;
use Illuminate\Support\Facades\Storage;

class SubmissionController extends Controller
{
    public function index(Assignment $assignment)
    {
        $submissions = Submission::with('student')
            ->where('assignment_id', $assignment->id)
            ->latest()
            ->get();

        return view('teacher.submissions.index', compact(
            'assignment',
            'submissions'
        ));
    }

   public function show(Submission $submission)
{
    $submission->load([
        'student',
        'assignment',
    ]);

    return view('teacher.submissions.show', compact('submission'));
}
    public function download(Submission $submission)
    {
        if (!Storage::exists($submission->file_path)) {
            abort(404, 'File tugas tidak ditemukan.');
        }

        return Storage::download(
            $submission->file_path,
            $submission->file_name
        );
    }
}