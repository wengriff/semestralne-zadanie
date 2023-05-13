<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\MathProblem;
use App\Models\Assignment;
use Illuminate\Support\Facades\Log;

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

    public function mathProblems()  // or you can name it examples if you wish
{
    return $this->belongsToMany(MathProblem::class, 'assignments', 'student_id', 'math_problem_id')
                
                ->withPivot(['status']) // if you want to access status field from pivot table
                ->withTimestamps(); // if your pivot table has timestamps
}

protected static function booted()
{
    static::created(function ($user) {
        Log::info('created user');
        if ($user->role === 'student') {
            Log::info('is student');
            // get all the math problems
            $mathProblems = MathProblem::all();
            Log::info('problem' . $mathProblems->count());
            foreach ($mathProblems as $mathProblem) {
                Assignment::create([
                    'student_id' => $user->id,
                    'math_problem_id' => $mathProblem->id,
                    'status' => 'generated',
                ]);
                Log::info('DONE');
            }
        }
    });
}
}
