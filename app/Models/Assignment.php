<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Assignment extends Model
{
    protected $fillable = [
        'teacher_id',
        'title',
        'description',
        'deadline',
        'subject',
        'class_name',
        'status',
    ];

    protected $casts = [
        'deadline' => 'datetime',
    ];

    public function teacher(): BelongsTo
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }
    public function aiInstructionAnalysis()
{
    return $this->hasOne(
        AiInstructionAnalysis::class,
        'assignment_id'
    );
}
public function submissions()
{
    return $this->hasMany(
        \App\Models\Submission::class,
        'assignment_id'
    );
}
}