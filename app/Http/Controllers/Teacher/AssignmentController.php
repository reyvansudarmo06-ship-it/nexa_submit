<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\Notification;
use App\Models\User;
use App\Services\SystemLogService;
use Illuminate\Http\Request;

class AssignmentController extends Controller
{
    public function index()
    {
        $assignments = Assignment::where(
            'teacher_id',
            auth()->id()
        )
            ->latest()
            ->get();

        return view(
            'teacher.assignments.index',
            compact('assignments')
        );
    }

    public function create()
    {
        return view('teacher.assignments.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'subject' => 'required|string|max:255',
            'class_name' => 'required|string|max:255',
            'deadline' => 'required|date',
        ]);

        $validated['teacher_id'] = auth()->id();
        $validated['status'] = 'active';

        $assignment = Assignment::create($validated);

        // SYSTEM LOG
        SystemLogService::log(
            'CREATE_ASSIGNMENT',
            'Guru membuat tugas baru: ' .
            $assignment->title
        );

        /*
        |--------------------------------------------------------------------------
        | NOTIFIKASI SISWA
        |--------------------------------------------------------------------------
        | Hanya siswa dari kelas yang sesuai dengan tugas
        | yang akan menerima notifikasi.
        */

        $students = User::where('role', 'student')
            ->where(
                'class_name',
                $assignment->class_name
            )
            ->get();

        foreach ($students as $student) {

            Notification::create([
                'user_id' => $student->id,
                'type' => 'new_assignment',
                'title' => 'Tugas Baru',
                'message' =>
                    'Ada tugas baru untuk kelas ' .
                    $assignment->class_name .
                    ': ' .
                    $assignment->title,
                'icon' => '📚',
                'action_url' => route(
                    'student.assignments.show',
                    $assignment
                ),
            ]);
        }

        return redirect()
            ->route('teacher.assignments')
            ->with(
                'success',
                'Tugas berhasil dibuat.'
            );
    }
}