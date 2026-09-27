<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserVerificationController extends Controller
{
    public function index()
    {
        $users = User::orderByRaw("
            CASE
                WHEN verification_status = 'pending' THEN 1
                WHEN verification_status = 'verified' THEN 2
                WHEN verification_status = 'rejected' THEN 3
                ELSE 4
            END
        ")->latest()->get();

        return view('admin.users.index', compact('users'));
    }

    public function verify(User $user)
    {
        $user->update([
            'verification_status' => 'verified',
            'is_active' => true,
            'verified_at' => now(),
            'verified_by' => auth()->id(),
        ]);

        return back()->with(
            'success',
            'Akun berhasil diverifikasi.'
        );
    }

    public function reject(User $user)
    {
        $user->update([
            'verification_status' => 'rejected',
            'is_active' => false,
            'verified_at' => null,
            'verified_by' => auth()->id(),
        ]);

        return back()->with(
            'success',
            'Akun berhasil ditolak.'
        );
    }
}