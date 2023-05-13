<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'math_problem_id',
        'status',
        'student_solution',
    ];

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }
    public function solution()
    {
        return $this->hasOne(AssignmentSolution::class);
    }

public function mathProblem() // or example
{
    return $this->belongsTo(MathProblem::class, 'math_problem_id'); // replace with Example::class if necessary
}


}
