<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

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

    public function parseFromLatexFile($filename)
    {
        // 1. Load the LaTeX file
        $content = Storage::disk('local')->get($filename); // Laravel way of reading a file

        // 2. Define regular expressions
        $taskRegex = '/\\\\begin\{task\}(.*?)\\\\includegraphics\{(.*?)\}.*?\\\\end\{task\}/s';
        $solutionRegex = '/\\\\begin\{equation\*?\}(.*?)\\\\end\{equation\*?\}/s';

        // 3. Get all matches
        preg_match_all($taskRegex, $content, $taskMatches);
        preg_match_all($solutionRegex, $content, $solutionMatches);

        // 4. Clean up the matches
        $tasks = array_map('trim', $taskMatches[1]);
        $imgs = array_map('trim', $taskMatches[2]);
        $equations = array_map('trim', $solutionMatches[1]);

        // 5. If there's a match, set the properties of the MathProblem instance.
        if (count($tasks) > 0 && count($equations) > 0) {
            $this->problem_statement = $tasks[0];
            $this->solution = $equations[0];
            $this->image_path = $imgs[0]; 
            // you might need to adjust this, if the image path is relative.
        }

        // 6. Return the updated instance.
        return $this;
    }
    // usage
    // $mathProblem = new MathProblem();
    // $mathProblem->parseFromLatexFile('file.tex');
    // $mathProblem->save();
}
