<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    public function create(): View
    {
        return view('auth.register');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                'unique:' . User::class,
            ],

            'role' => [
                'required',
                'in:student,teacher',
            ],

            'birth_day' => [
                'required',
                'integer',
                'between:1,31',
            ],

            'birth_month' => [
                'required',
                'integer',
                'between:1,12',
            ],

            'birth_year' => [
                'required',
                'integer',
                'min:1950',
                'max:' . now()->year,
            ],

            'password' => [
                'required',
                'confirmed',
                Rules\Password::defaults(),
            ],
        ]);

        if (!checkdate(
            (int) $request->birth_month,
            (int) $request->birth_day,
            (int) $request->birth_year
        )) {
            return back()
                ->withErrors([
                    'birth_date' => 'Tanggal lahir tidak valid.',
                ])
                ->withInput();
        }

        $birthDate = sprintf(
            '%04d-%02d-%02d',
            $request->birth_year,
            $request->birth_month,
            $request->birth_day
        );

        $user = User::create([
            'name' => $request->name,
            'email' => strtolower($request->email),
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'birth_date' => $birthDate,
            'verification_status' => 'verified',
            'is_active' => true,
            'verified_at' => now(),
            'verified_by' => null,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect()->route('dashboard');
    }
}
