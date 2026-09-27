<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\Submission;
use App\Models\User;
use App\Models\AiAnalysis;
use App\Models\TeacherReview;

class AnalyticsController extends Controller
{
    public function index()
    {
        // Total siswa
        $totalStudents = User::where('role', 'student')->count();

        // Total tugas aktif
        $totalAssignments = Assignment::where('status', 'active')->count();

        // Total pengumpulan
        $totalSubmissions = Submission::count();

        // Total submission yang sudah dianalisis AI
        $totalAiAnalyzed = AiAnalysis::count();

        // Total yang sudah direview guru
        $totalReviewed = TeacherReview::count();

        // Total submission terlambat
        $lateSubmissions = Submission::whereHas('assignment', function ($query) {
            $query->whereColumn(
                'submissions.created_at',
                '>',
                'assignments.deadline'
            );
        })->count();

        // Submission yang belum direview
        $pendingReview = Submission::whereDoesntHave('teacherReview')
            ->count();

        // Rata-rata nilai AI
        $averageAiScore = AiAnalysis::whereNotNull('score')
            ->avg('score');

        // Nilai AI tertinggi
        $highestAiScore = AiAnalysis::max('score');

        // Nilai AI terendah
        $lowestAiScore = AiAnalysis::min('score');

        // Jumlah submission per tugas
        $assignmentStats = Assignment::withCount('submissions')
            ->where('status', 'active')
            ->orderByDesc('submissions_count')
            ->get();

        return view('teacher.analytics', compact(
            'totalStudents',
            'totalAssignments',
            'totalSubmissions',
            'totalAiAnalyzed',
            'totalReviewed',
            'lateSubmissions',
            'pendingReview',
            'averageAiScore',
            'highestAiScore',
            'lowestAiScore',
            'assignmentStats'
        ));
    }
}