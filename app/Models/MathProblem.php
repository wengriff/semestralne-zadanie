<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MathProblem extends Model
{
    use HasFactory;

    protected $fillable = [
        'section_id',
        'problem_statement',
        'solution',
        'image_path',
    ];

    public function latexFile()
    {
        return $this->belongsTo(LatexFile::class);
    }
    public function parseLatexContent()
    {
        $pattern = '/\\\\section\*\{([A-Z0-9]+)\}.*?\\\\begin\{task\}(.*?)\\\\includegraphics\{(.*?)\}.*?\\\\end\{task\}.*?\\\\begin\{solution\}(.*?)\\\\end\{solution\}/s';

        $content = Storage::get($this->file_path);

        if (preg_match_all($pattern, $content, $matches, PREG_SET_ORDER)) {
            foreach ($matches as $match) {
                $mathProblem = new MathProblem([
                    'section_id' => $match[1],
                    'problem_statement' => $match[2],
                    'solution' => $match[4],
                    'image_path' => $match[3],
                ]);

                $this->mathProblems()->save($mathProblem);
            }
        }
    }
}
