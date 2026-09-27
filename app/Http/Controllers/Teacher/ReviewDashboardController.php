<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\Submission;

class ReviewDashboardController extends Controller
{
    public function index()
    {
        $assignments = Assignment::where(
            'teacher_id',
            auth()->id()
        )
        ->withCount('submissions')
        ->latest()
        ->get();

        $assignmentIds = $assignments->pluck('id');

        $submissions = Submission::with([
            'student',
            'assignment',
            'aiAnalysis',
            'teacherReview',
        ])
        ->whereIn('assignment_id', $assignmentIds)
        ->latest()
        ->get();

        $totalSubmissions = $submissions->count();

        $reviewed = $submissions->filter(
            fn ($submission) => $submission->teacherReview
        )->count();

        $pending = $totalSubmissions - $reviewed;

        $aiAnalyzed = $submissions->filter(
            fn ($submission) => $submission->aiAnalysis
        )->count();

        return view(
            'teacher.review-dashboard',
            compact(
                'assignments',
                'submissions',
                'totalSubmissions',
                'reviewed',
                'pending',
                'aiAnalyzed'
            )
        );
    }
}