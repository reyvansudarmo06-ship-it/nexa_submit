<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Submission;

class AiCheckController extends Controller
{
    public function index()
    {
        $submissions = Submission::with([
            'assignment',
            'aiAnalysis',
        ])
        ->where('student_id', auth()->id())
        ->latest()
        ->get();

        return view(
            'student.ai-check',
            compact('submissions')
        );
    }
}
