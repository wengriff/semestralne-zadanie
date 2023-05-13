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
        'equation',
        'assignmentSet_id',
        
    ];


    public function parseFromLatexFile($filename)
    { //Storage::disk('local')->get
        // 1. Load the LaTeX file
        $content = file_get_contents($filename); // Laravel way of reading a file
        
        // 2. Define regular expressions
        $taskWithEquationRegex = '/\\\\begin\{task\}(.*?)\\\\begin\{equation\*?\}(.*?)\\\\end\{equation\*?\}.*?\\\\end\{task\}/s';
        $taskWithImageRegex = '/\\\\begin\{task\}(.*?)\\\\includegraphics\{(.*?)\}.*?\\\\end\{task\}/s';
        $solutionRegex = '/\\\\begin\{solution\}.*?\\\\begin\{equation\*?\}(.*?)\\\\end\{equation\*?\}.*?\\\\end\{solution\}/s';
        

       // 3. Get all matches
    preg_match_all($taskWithEquationRegex, $content, $taskWithEquationMatches);
    preg_match_all($taskWithImageRegex, $content, $taskWithImageMatches);
    preg_match_all($solutionRegex, $content, $solutionMatches);

    // 4. Clean up the matches
    $tasksWithEquation = array_map('trim', $taskWithEquationMatches[1]);
    $tasksWithImage = array_map('trim', $taskWithImageMatches[1]);
    $equations = array_map('trim', $taskWithEquationMatches[2]);
    $imgs = array_map('trim', $taskWithImageMatches[2]);
    $solutions = array_map('trim', $solutionMatches[1]);

    $problemData = [];
    $numProblems = max(count($tasksWithEquation), count($tasksWithImage));

    // 5. If there's a match, set the properties of the MathProblem instance.
    for ($i = 0; $i < $numProblems; $i++) {
        $problem_statement = isset($tasksWithEquation[$i]) ? $tasksWithEquation[$i] : $tasksWithImage[$i];
        $solution = $solutions[$i];
        $image_path = isset($imgs[$i]) ? $imgs[$i] : '';
        $equation = isset($equations[$i]) ? $equations[$i] : '';

        $problemData[] = [
            'problem_statement' => $problem_statement,
            'solution' => $solution,
            'image_path' => $image_path,
            'equation' => $equation,
        ];
    }

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
