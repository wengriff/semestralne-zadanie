<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'example_id',
        'status',
    ];

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function example()
    {
        return $this->belongsTo(Example::class);
    }

    public function solution()
    {
        return $this->hasOne(AssignmentSolution::class);
    }
}
