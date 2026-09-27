<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AiAnalysis extends Model
{
    protected $fillable = [
        'submission_id',
        'summary',
        'instruction_match',
        'strengths',
        'weaknesses',
        'suggestions',
        'status',
        'score',

        // Breakdown nilai NEXA AI
        'instruction_score',
        'completeness_score',
        'quality_score',
        'neatness_score',
        'deadline_score',

        'completeness',
        'quality',
        'deadline_status',
    ];

    protected $casts = [
        'score' => 'integer',
        'instruction_score' => 'integer',
        'completeness_score' => 'integer',
        'quality_score' => 'integer',
        'neatness_score' => 'integer',
        'deadline_score' => 'integer',
    ];

    public function submission(): BelongsTo
    {
        return $this->belongsTo(Submission::class);
    }
}