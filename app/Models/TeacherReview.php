<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TeacherReview extends Model
{
    protected $fillable = [
        'submission_id',
        'teacher_id',
        'score',
        'comment',
        'status',
    ];

    protected $casts = [
        'score' => 'integer',
    ];

    public function submission(): BelongsTo
    {
        return $this->belongsTo(Submission::class);
    }

    public function teacher(): BelongsTo
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }
}