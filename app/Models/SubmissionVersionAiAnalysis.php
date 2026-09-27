<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SubmissionVersionAiAnalysis extends Model
{
    protected $fillable = [
        'submission_version_id',
        'summary',
        'instruction_match',
        'strengths',
        'weaknesses',
        'suggestions',
        'score',
        'completeness',
        'quality',
        'status',
    ];

    protected $casts = [
        'score' => 'integer',
    ];

    public function submissionVersion(): BelongsTo
    {
        return $this->belongsTo(
            SubmissionVersion::class,
            'submission_version_id'
        );
    }
}