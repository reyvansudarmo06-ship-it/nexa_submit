<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Submission;

class SmartRevisionController extends Controller
{
    public function index()
    {
        $studentId = auth()->id();

        $submissions = Submission::with([
            'assignment',
            'aiAnalysis',
            'teacherReview',
        ])
        ->where('student_id', $studentId)
        ->latest('created_at')
        ->get();

        return view(
            'student.smart-revision',
            compact('submissions')
        );
    }
}