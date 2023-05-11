<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignmentSet extends Model
{
    use HasFactory;
    
    protected $table = 'latex_files';

    protected $fillable = [
        'file_path',
        'starting_date',
        'deadline',
        'points',
    ];
}
