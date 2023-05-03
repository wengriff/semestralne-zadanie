<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LatexFile extends Model
{
    use HasFactory;

    protected $fillable = [
        'file_path',
    ];

    public function examples()
    {
        return $this->hasMany(Example::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    // Add this method to retrieve the content of the LaTeX file
    public function getContent()
    {
        return Storage::disk('latex')->get($this->file_path);
    }
}
