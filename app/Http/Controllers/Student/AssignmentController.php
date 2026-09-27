<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\Submission;

class AssignmentController extends Controller
{
    public function index()
    {
        $assignments = Assignment::where('status', 'active')
            ->orderBy('deadline', 'asc')
            ->get();

        return view(
            'student.assignments.index',
            compact('assignments')
        );
    }

    public function show(Assignment $assignment)
    {
        $submission = Submission::with([
            'aiAnalysis',
            'teacherReview',
        ])
        ->where('assignment_id', $assignment->id)
        ->where('student_id', auth()->id())
        ->first();

        return view(
            'student.assignments.show',
            compact(
                'assignment',
                'submission'
            )
        );
    }
}