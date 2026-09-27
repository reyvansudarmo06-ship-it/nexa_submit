<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureAccountVerified
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (!$user) {
            return redirect()->route('login');
        }

        if (
            $user->verification_status !== 'verified' ||
            !$user->is_active
        ) {
            auth()->logout();

            return redirect()
                ->route('login')
                ->with(
                    'error',
                    'Akun kamu belum diverifikasi atau sedang dinonaktifkan.'
                );
        }

        return $next($request);
    }
}