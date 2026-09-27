<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VersionComparison extends Model
{
    protected $fillable = [
        'submission_id',
        'from_version_id',
        'to_version_id',
        'from_score',
        'to_score',
        'score_change',
        'improvement_summary',
        'improved_areas',
        'remaining_issues',
        'ai_recommendation',
        'status',
    ];

    protected $casts = [
        'from_score' => 'integer',
        'to_score' => 'integer',
        'score_change' => 'integer',
    ];

    public function submission(): BelongsTo
    {
        return $this->belongsTo(
            Submission::class
        );
    }

    public function fromVersion(): BelongsTo
    {
        return $this->belongsTo(
            SubmissionVersion::class,
            'from_version_id'
        );
    }

    public function toVersion(): BelongsTo
    {
        return $this->belongsTo(
            SubmissionVersion::class,
            'to_version_id'
        );
    }
}