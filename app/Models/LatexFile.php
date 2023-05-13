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

 /*   public function parseAndStoreMathProblems()
{
    // Get the content of the file
    $content = $this->getContent();

    // Use the parser to populate the properties of multiple MathProblem instances
    $problemsData = (new MathProblem)->parseFromLatexFile($content);

    // Create a new AssignmentSet
  //  $assignmentSet = new AssignmentSet([
    //    'file_path' => $this->file_path,
        // 'starting_date' => ...,  // set these fields as necessary
        // 'deadline' => ..., 
        // 'points' => ..., 
   // ]);
    $assignmentSet->save();

    // Loop over each problem's data and save it
    foreach ($problemsData as $problemData) {
        $mathProblem = new MathProblem($problemData);
        $mathProblem->assignmentSet()->associate($assignmentSet); // associate before saving
        $mathProblem->save();
    }

    return $assignmentSet; // Return the AssignmentSet instance, which now contains all the MathProblem instances
}*/
}
