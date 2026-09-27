<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SubmissionVersion extends Model
{
    protected $fillable = [
        'submission_id',
        'version_number',
        'file_name',
        'file_path',
        'note',
        'status',
    ];

    public function submission(): BelongsTo
    {
        return $this->belongsTo(Submission::class);
    }
    public function aiAnalysis()
{
    return $this->hasOne(
        SubmissionVersionAiAnalysis::class,
        'submission_version_id'
    );
}
}