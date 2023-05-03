<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'surname',
        'student_id',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the assignments for the user.
     */
    public function assignments()
    {
        return $this->hasMany(Assignment::class, 'student_id');
    }

    /**
     * Determine if the user is a teacher.
     *
     * @return bool
     */
    public function isTeacher()
    {
        return $this->role === 'teacher';
    }

     /**
     * Determine if the user is a student.
     *
     * @return bool
     */
    public function isStudent()
    {
        return $this->role === 'student';
    }
}
