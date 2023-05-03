<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Example extends Model
{
    use HasFactory;

    protected $fillable = [
        'latex_file_id',
        'example_content',
        'language_id',
    ];

    /**
     * Get the latex file that the example belongs to.
     */
    public function latexFile()
    {
        return $this->belongsTo(LatexFile::class);
    }

    /**
     * Get the language that the example belongs to.
     */
    public function language()
    {
        return $this->belongsTo(Language::class);
    }

    /**
     * Get the assignments associated with the example.
     */
    public function assignments()
    {
        return $this->hasMany(Assignment::class);
    }
}
