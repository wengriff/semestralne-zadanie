<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignmentSolution extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'assignment_id',
        'solution_file_path',
    ];

    /**
     * Get the assignment associated with this solution.
     */
    public function assignment()
    {
        return $this->belongsTo(Assignment::class);
    }
}
