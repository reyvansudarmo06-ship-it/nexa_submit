<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\Submission;

class DashboardController extends Controller
{
    public function index()
    {
        $studentId = auth()->id();

        $assignments = Assignment::where('status', 'active')
            ->orderBy('deadline', 'asc')
            ->get();

        $submissions = Submission::where('student_id', $studentId)
            ->get()
            ->keyBy('assignment_id');

        $totalAssignments = $assignments->count();

        $submittedCount = $assignments
            ->filter(function ($assignment) use ($submissions) {
                return $submissions->has($assignment->id);
            })
            ->count();

        $pendingCount = $totalAssignments - $submittedCount;

        // Progress tugas dalam persen
        $progressPercentage = $totalAssignments > 0
            ? round(($submittedCount / $totalAssignments) * 100)
            : 0;

        $nearestDeadline = $assignments
            ->filter(function ($assignment) {
                return $assignment->deadline &&
                    now()->lte($assignment->deadline);
            })
            ->first();

        $recentSubmissions = Submission::with('assignment')
            ->where('student_id', $studentId)
            ->latest()
            ->take(5)
            ->get();

        $aiAnalysisCount = Submission::where('student_id', $studentId)
            ->whereHas('aiAnalysis')
            ->count();

        return view('dashboard', compact(
            'assignments',
            'submissions',
            'totalAssignments',
            'submittedCount',
            'pendingCount',
            'progressPercentage',
            'nearestDeadline',
            'recentSubmissions',
            'aiAnalysisCount'
        ));
    }
}