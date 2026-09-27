<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AiInstructionAnalysis extends Model
{
    protected $fillable = [
        'assignment_id',
        'summary',
        'objective',
        'requirements',
        'checklist',
        'important_notes',
        'step_by_step',
        'status',
    ];

    public function assignment(): BelongsTo
    {
        return $this->belongsTo(
            Assignment::class,
            'assignment_id'
        );
    }
}