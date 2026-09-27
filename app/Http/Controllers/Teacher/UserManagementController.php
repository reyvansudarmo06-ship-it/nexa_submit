<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserManagementController extends Controller
{
    public function index()
    {
        $users = User::latest()->get();

        $totalUsers = $users->count();

        $totalStudents = $users->where('role', 'student')->count();

        $totalTeachers = $users->where('role', 'teacher')->count();

        return view(
            'teacher.users',
            compact(
                'users',
                'totalUsers',
                'totalStudents',
                'totalTeachers'
            )
        );
    }
}