<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Models\Submission;

// Admin
use App\Http\Controllers\Admin\AdminDashboardController;

// Notification
use App\Http\Controllers\NotificationController;

// Student
use App\Http\Controllers\Student\AssignmentController as StudentAssignmentController;
use App\Http\Controllers\Student\SubmissionController;
use App\Http\Controllers\Student\SubmissionHealthController;
use App\Http\Controllers\Student\SubmissionPassportController;
use App\Http\Controllers\Student\SmartRevisionController;
use App\Http\Controllers\Student\SubmissionVersionController;
use App\Http\Controllers\Student\VersionComparisonController;
use App\Http\Controllers\Student\DeadlineProgressController;
use App\Http\Controllers\Student\AiInstructionController;
use App\Http\Controllers\Student\AiAssistantController;
use App\Http\Controllers\Student\AiChatController;

// Teacher
use App\Http\Controllers\Teacher\AssignmentController as TeacherAssignmentController;
use App\Http\Controllers\Teacher\SubmissionController as TeacherSubmissionController;
use App\Http\Controllers\Teacher\ReviewController;
use App\Http\Controllers\Teacher\AnalyticsController;
use App\Http\Controllers\Teacher\ReviewDashboardController;
use App\Http\Controllers\Teacher\UserManagementController;
use App\Http\Controllers\Teacher\SystemLogController;

// AI
use App\Http\Controllers\AI\GeminiTestController;
use App\Http\Controllers\AI\AiAnalysisController;


/*
|--------------------------------------------------------------------------
| PUBLIC
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});


/*
|--------------------------------------------------------------------------
| DASHBOARD
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified.account', 'verified'])
    ->name('dashboard');


/*
|--------------------------------------------------------------------------
| AI TEST
|--------------------------------------------------------------------------
*/

Route::get('/ai-test', [GeminiTestController::class, 'test']);


/*
|--------------------------------------------------------------------------
| STUDENT
|--------------------------------------------------------------------------
*/

Route::middleware([
    'auth',
    'verified.account',
    'role:student',
])->group(function () {

    Route::get(
        '/assignments',
        [StudentAssignmentController::class, 'index']
    )->name('student.assignments');

    Route::get(
        '/assignments/{assignment}',
        [StudentAssignmentController::class, 'show']
    )->name('student.assignments.show');

    Route::get(
        '/assignments/{assignment}/submit',
        [SubmissionController::class, 'create']
    )->name('student.submissions.create');

    Route::post(
        '/assignments/{assignment}/submit',
        [SubmissionController::class, 'store']
    )->name('student.submissions.store');

    Route::get(
        '/submission-health',
        [SubmissionHealthController::class, 'index']
    )->name('student.submission-health');

    Route::get(
        '/submission-passport',
        [SubmissionPassportController::class, 'index']
    )->name('student.submission-passport');

    Route::get(
        '/smart-revision',
        [SmartRevisionController::class, 'index']
    )->name('student.smart-revision');

    Route::get(
        '/deadline-progress',
        [DeadlineProgressController::class, 'index']
    )->name('student.deadline-progress');

    Route::get(
        '/submission-versions',
        function () {

            $submission = Submission::where(
                'student_id',
                auth()->id()
            )
            ->latest()
            ->first();

            if (!$submission) {
                return redirect()
                    ->route('student.assignments')
                    ->with(
                        'error',
                        'Belum ada tugas yang dikumpulkan.'
                    );
            }

            return redirect()->route(
                'student.submission-versions',
                $submission
            );
        }
    )->name('student.submission-versions.home');

    Route::get(
        '/submission/{submission}/versions',
        [SubmissionVersionController::class, 'index']
    )->name('student.submission-versions');

    Route::post(
        '/submission/{submission}/versions/initial',
        [SubmissionVersionController::class, 'storeInitialVersion']
    )->name('student.submission-versions.initial');

    Route::post(
        '/submission/{submission}/versions',
        [SubmissionVersionController::class, 'store']
    )->name('student.submission-versions.store');

    Route::post(
        '/ai/analyze-version/{version}',
        [AiAnalysisController::class, 'analyzeVersion']
    )->name('student.ai.analyze-version');

    Route::post(
        '/submission/{submission}/compare/{fromVersion}/{toVersion}',
        [VersionComparisonController::class, 'compare']
    )->name('student.version-comparison');

    Route::get(
        '/ai-check',
        [\App\Http\Controllers\Student\AiCheckController::class, 'index']
    )->name('student.ai-check');

    Route::get(
        '/ai-instruction',
        [AiInstructionController::class, 'index']
    )->name('student.ai-instruction');

    Route::post(
        '/ai-instruction/{assignment}/analyze',
        [AiInstructionController::class, 'analyze']
    )->name('student.ai-instruction.analyze');

    Route::get(
        '/ai-assistant',
        [AiAssistantController::class, 'index']
    )->name('student.ai-assistant');

    Route::post(
        '/ai-assistant/ask',
        [AiAssistantController::class, 'ask']
    )->name('student.ai-assistant.ask');

    Route::get(
        '/submission/{submission}/ai-chat',
        function (Submission $submission) {

            if ((int) $submission->student_id !== (int) auth()->id()) {
                abort(403, 'Akses tidak diizinkan.');
            }

            $submission->load([
                'assignment',
                'aiAnalysis',
                'teacherReview',
                'aiChatMessages',
            ]);

            return view(
                'student.ai-chat',
                compact('submission')
            );
        }
    )->name('student.ai-chat');

    Route::post(
        '/submission/{submission}/ai-chat',
        [AiChatController::class, 'ask']
    )->name('student.ai-chat.ask');

});


/*
|--------------------------------------------------------------------------
| NOTIFICATIONS
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get(
        '/notifications',
        [NotificationController::class, 'index']
    )->name('notifications.index');

    Route::post(
        '/notifications/read-all',
        [NotificationController::class, 'readAll']
    )->name('notifications.read-all');

    Route::post(
        '/notifications/{notification}/read',
        [NotificationController::class, 'read']
    )->name('notifications.read');

});


/*
|--------------------------------------------------------------------------
| TEACHER
|--------------------------------------------------------------------------
*/

Route::middleware([
    'auth',
    'verified.account',
    'role:teacher',
])->group(function () {

    Route::get(
        '/teacher/assignments',
        [TeacherAssignmentController::class, 'index']
    )->name('teacher.assignments');

    Route::get(
        '/teacher/assignments/create',
        [TeacherAssignmentController::class, 'create']
    )->name('teacher.assignments.create');

    Route::post(
        '/teacher/assignments',
        [TeacherAssignmentController::class, 'store']
    )->name('teacher.assignments.store');

    Route::get(
        '/teacher/assignments/{assignment}/submissions',
        [TeacherSubmissionController::class, 'index']
    )->name('teacher.submissions.index');

    Route::get(
        '/teacher/submissions/{submission}',
        [TeacherSubmissionController::class, 'show']
    )->name('teacher.submissions.show');

    Route::get(
        '/teacher/submissions/{submission}/download',
        [TeacherSubmissionController::class, 'download']
    )->name('teacher.submissions.download');

    Route::post(
        '/teacher/submissions/{submission}/review',
        [ReviewController::class, 'store']
    )->name('teacher.reviews.store');

    Route::get(
        '/teacher/analytics',
        [AnalyticsController::class, 'index']
    )->name('teacher.analytics');

    Route::get(
        '/teacher/reviews',
        [ReviewDashboardController::class, 'index']
    )->name('teacher.reviews');

    Route::get(
        '/teacher/users',
        [UserManagementController::class, 'index']
    )->name('teacher.users');

    Route::get(
        '/teacher/logs',
        [SystemLogController::class, 'index']
    )->name('teacher.logs');

    Route::get(
        '/teacher/logs/export',
        [SystemLogController::class, 'export']
    )->name('teacher.logs.export');

});


/*
|--------------------------------------------------------------------------
| AI ANALYSIS
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::post(
        '/ai/analyze/{submission}',
        [AiAnalysisController::class, 'analyze']
    )->name('ai.analyze');

});


/*
|--------------------------------------------------------------------------
| PROFILE
|--------------------------------------------------------------------------
*/

Route::middleware([
    'auth',
    'verified.account',
])->group(function () {

    Route::get(
        '/profile',
        [ProfileController::class, 'edit']
    )->name('profile.edit');

    Route::patch(
        '/profile',
        [ProfileController::class, 'update']
    )->name('profile.update');

    Route::delete(
        '/profile',
        [ProfileController::class, 'destroy']
    )->name('profile.destroy');

});


/* 
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/

Route::middleware([
    'auth',
    'verified.account',
    'admin',
])->group(function () {

    Route::get(
        '/admin',
        [AdminDashboardController::class, 'index']
    )->name('admin.dashboard');

    Route::get(
        '/admin/users',
        [\App\Http\Controllers\Admin\UserVerificationController::class, 'index']
    )->name('admin.users.index');

    Route::post(
        '/admin/users/{user}/verify',
        [\App\Http\Controllers\Admin\UserVerificationController::class, 'verify']
    )->name('admin.users.verify');

    Route::post(
        '/admin/users/{user}/reject',
        [\App\Http\Controllers\Admin\UserVerificationController::class, 'reject']
    )->name('admin.users.reject');

});


/*
|--------------------------------------------------------------------------
| AUTHENTICATION
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';
