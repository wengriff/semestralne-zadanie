<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'latex_file_id',
        'image_path',
    ];

    /**
     * Get the latex file that the image belongs to.
     */
    public function latexFile()
    {
        return $this->belongsTo(LatexFile::class);
    }
}
