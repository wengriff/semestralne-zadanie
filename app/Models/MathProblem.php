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
        'assignmentSet_id',
        'student_solution',
    ];


    public function parseFromLatexFile($filename)
    { //Storage::disk('local')->get
        // 1. Load the LaTeX file
        $content = file_get_contents($filename); // Laravel way of reading a file
        
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

        $problemData=[];
        $numProblems=count($tasks);
        // 5. If there's a match, set the properties of the MathProblem instance.
        for ($i = 0; $i < $numProblems; $i++) {
            $problemData[] = [
                'problem_statement' => $tasks[$i],
                'solution' => $equations[$i],
                'image_path' => $imgs[$i],
            ];
        }
            // you might need to adjust this, if the image path is relative.
        

        // 6. Return the updated instance.
        return $problemData;
    }
    public function students()
    {
    return $this->belongsToMany(User::class, 'assignments', 'math_problem_id', 'student_id')
               
                ->withPivot(['status']) // if you want to access status field from pivot table
                ->withTimestamps(); // if your pivot table has timestamps
    }
    public function assignmentSet()
{
    return $this->belongsTo(AssignmentSet::class);
}
}
