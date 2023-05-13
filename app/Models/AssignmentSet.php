<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignmentSet extends Model
{
    use HasFactory;
    
   

    protected $fillable = [
        'file_path',
        'starting_date',
        'deadline',
        'points',
    ];

    public function mathProblems()
{
    return $this->hasMany(MathProblem::class);
}
}
