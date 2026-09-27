<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Submission;
use App\Models\SubmissionVersion;
use Illuminate\Http\Request;

class SubmissionVersionController extends Controller
{
    public function index(Submission $submission)
    {
        if ($submission->student_id !== auth()->id()) {
            abort(403, 'Akses tidak diizinkan.');
        }

        $submission->load([
            'assignment',
            'versions.aiAnalysis',
        ]);

        return view(
            'student.submission-versions',
            compact('submission')
        );
    }

    public function storeInitialVersion(Submission $submission)
    {
        if ($submission->student_id !== auth()->id()) {
            abort(403, 'Akses tidak diizinkan.');
        }

        if ($submission->versions()->exists()) {
            return back()->with(
                'info',
                'Version 1 sudah tersedia.'
            );
        }

        SubmissionVersion::create([
            'submission_id' => $submission->id,
            'version_number' => 1,
            'file_name' => $submission->file_name,
            'file_path' => $submission->file_path,
            'note' => $submission->note,
            'status' => 'submitted',
        ]);

        return back()->with(
            'success',
            'Version 1 berhasil dibuat.'
        );
    }

    public function store(Request $request, Submission $submission)
    {
        if ($submission->student_id !== auth()->id()) {
            abort(403, 'Akses tidak diizinkan.');
        }

        $validated = $request->validate([
            'file' => 'required|file|max:10240',
            'note' => 'nullable|string|max:2000',
        ]);

        $lastVersion = $submission->versions()
            ->max('version_number');

        $nextVersion = ($lastVersion ?? 0) + 1;

        $file = $request->file('file');

        $path = $file->store('submission-versions');

        SubmissionVersion::create([
            'submission_id' => $submission->id,
            'version_number' => $nextVersion,
            'file_name' => $file->getClientOriginalName(),
            'file_path' => $path,
            'note' => $validated['note'] ?? null,
            'status' => 'submitted',
        ]);

        return back()->with(
            'success',
            "Version {$nextVersion} berhasil ditambahkan."
        );
    }
}