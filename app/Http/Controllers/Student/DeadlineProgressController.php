<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\Submission;
use Illuminate\Support\Carbon;

class DeadlineProgressController extends Controller
{
    public function index()
    {
        $assignments = Assignment::where('status', 'active')
            ->with([
                'teacher',
            ])
            ->orderBy('deadline', 'asc')
            ->get();

        $submissions = Submission::where('student_id', auth()->id())
            ->get()
            ->keyBy('assignment_id');

        return view(
            'student.deadline-progress',
            compact(
                'assignments',
                'submissions'
            )
        );
    }
}