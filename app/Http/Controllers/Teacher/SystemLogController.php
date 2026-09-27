<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\SystemLog;
use App\Models\User;
use Illuminate\Http\Request;

class SystemLogController extends Controller
{
    public function index(Request $request)
    {
        $query = SystemLog::with('user')
            ->latest();

        // Search log
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('action', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhere('ip_address', 'like', "%{$search}%")
                    ->orWhereHas('user', function ($userQuery) use ($search) {
                        $userQuery->where('name', 'like', "%{$search}%")
                            ->orWhere('email', 'like', "%{$search}%");
                    });
            });
        }

        // Filter berdasarkan aktivitas
        if ($request->filled('action')) {
            $query->where('action', $request->action);
        }

        // Filter berdasarkan user
        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        // Data log
        $logs = $query
            ->paginate(30)
            ->withQueryString();

        // Statistik
        $totalLogs = SystemLog::count();

        $aiLogs = SystemLog::whereIn('action', [
            'AI_ANALYSIS',
            'AI_VERSION_ANALYSIS',
        ])->count();

        $submissionLogs = SystemLog::where(
            'action',
            'SUBMISSION_CREATED'
        )->count();

        $reviewLogs = SystemLog::where(
            'action',
            'TEACHER_REVIEW'
        )->count();

        // Daftar user
        $users = User::whereIn('id', function ($query) {
            $query->select('user_id')
                ->from('system_logs')
                ->whereNotNull('user_id')
                ->distinct();
        })
        ->orderBy('name')
        ->get();

        return view(
            'teacher.logs',
            compact(
                'logs',
                'users',
                'totalLogs',
                'aiLogs',
                'submissionLogs',
                'reviewLogs'
            )
        );
    }


    public function export(Request $request)
    {
        $query = SystemLog::with('user')
            ->latest();

        // Search
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('action', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhere('ip_address', 'like', "%{$search}%")
                    ->orWhereHas('user', function ($userQuery) use ($search) {
                        $userQuery->where('name', 'like', "%{$search}%")
                            ->orWhere('email', 'like', "%{$search}%");
                    });
            });
        }

        // Filter aktivitas
        if ($request->filled('action')) {
            $query->where('action', $request->action);
        }

        // Filter user
        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        $logs = $query->get();

        $filename = 'nexa-submit-logs-' . now()->format('Y-m-d-H-i-s') . '.csv';

        return response()->streamDownload(function () use ($logs) {

            $handle = fopen('php://output', 'w');

            fputcsv($handle, [
                'Waktu',
                'User',
                'Role',
                'Aktivitas',
                'Deskripsi',
                'IP Address',
            ]);

            foreach ($logs as $log) {
                fputcsv($handle, [
                    $log->created_at?->format('Y-m-d H:i:s'),
                    $log->user?->name ?? 'System',
                    $log->user?->role ?? '-',
                    $log->action,
                    $log->description ?? '-',
                    $log->ip_address ?? '-',
                ]);
            }

            fclose($handle);

        }, $filename, [
            'Content-Type' => 'text/csv',
        ]);
    }
}