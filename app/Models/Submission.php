<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\VersionComparison;
use App\Models\AiChatMessage;

class Submission extends Model
{
    protected $fillable = [
        'assignment_id',
        'student_id',
        'file_name',
        'file_path',
        'note',
        'status',
    ];

    public function assignment(): BelongsTo
    {
        return $this->belongsTo(Assignment::class);
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function aiAnalysis()
    {
        return $this->hasOne(AiAnalysis::class);
    }

    public function teacherReview()
    {
        return $this->hasOne(TeacherReview::class);
    }

    public function versions()
    {
        return $this->hasMany(
            SubmissionVersion::class
        )->orderBy('version_number', 'desc');
    }

    public function versionComparisons()
    {
        return $this->hasMany(
            VersionComparison::class
        );
    }

    public function aiChatMessages()
    {
        return $this->hasMany(
            AiChatMessage::class
        )->orderBy('created_at', 'asc');
    }
}