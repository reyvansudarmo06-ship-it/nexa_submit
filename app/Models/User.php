<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Assignment;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

  protected $fillable = [
    'name',
    'email',
    'password',
    'role',
    'birth_date',
    'verification_status',
    'is_active',
    'verified_at',
    'verified_by',
    'class_name',
];
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function assignments()
    {
        return $this->hasMany(Assignment::class, 'teacher_id');
    }
    public function teacherReviews()
{
    return $this->hasMany(TeacherReview::class, 'teacher_id');
}
}