<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\Submission;

class SubmissionHealthController extends Controller
{
    public function index()
    {
        $studentId = auth()->id();

        $assignments = Assignment::where('status', 'active')
            ->orderBy('deadline', 'asc')
            ->get();

        $totalAssignments = $assignments->count();

        $submissions = Submission::with([
            'assignment',
            'aiAnalysis',
            'teacherReview',
        ])
        ->where('student_id', $studentId)
        ->get();

        $submittedCount = $submissions->count();

        $aiAnalyzedCount = $submissions
            ->filter(fn ($submission) => $submission->aiAnalysis)
            ->count();

        $reviewedCount = $submissions
            ->filter(fn ($submission) => $submission->teacherReview)
            ->count();

        $pendingCount = max(
            0,
            $totalAssignments - $submittedCount
        );

        $submissionProgress = $totalAssignments > 0
            ? round(($submittedCount / $totalAssignments) * 100)
            : 0;

        $aiProgress = $submittedCount > 0
            ? round(($aiAnalyzedCount / $submittedCount) * 100)
            : 0;

        $reviewProgress = $submittedCount > 0
            ? round(($reviewedCount / $submittedCount) * 100)
            : 0;

        return view('student.submission-health', compact(
            'assignments',
            'submissions',
            'totalAssignments',
            'submittedCount',
            'aiAnalyzedCount',
            'reviewedCount',
            'pendingCount',
            'submissionProgress',
            'aiProgress',
            'reviewProgress'
        ));
    }
}