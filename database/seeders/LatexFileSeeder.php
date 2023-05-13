<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\AssignmentSet;
use App\Models\MathProblem;
use App\Models\Assignment;
use Illuminate\Filesystem\Filesystem;
class LatexFileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(){
   
  
    $folderPath = storage_path('latex');
    echo $folderPath;
    $files = glob($folderPath . '/*.tex');

    // Get all the students from the database
    $students = User::where('role', 'student')->get();

    foreach ($files as $file) {
        $startingDate = '2023-05-12 00:00:00'; // Set the starting date for each file
        $deadline = '2023-05-19 00:00:00'; // Set the deadline for each file
        $points = 10; // Set the points for each file
       
        

        // Create a new AssignmentSet
        $assignmentSet = AssignmentSet::create([
            'file_path' => $file,
            'starting_date' => $startingDate,
            'deadline' => $deadline,
            'points' => $points,
        ]);
         
        // Use the parser to populate the properties of multiple MathProblem instances
        $problemsData = (new MathProblem)->parseFromLatexFile($file);
        
        // For each problem data, create a new MathProblem and associate it with the AssignmentSet
        foreach ($problemsData as $problemData) {
            
            $problem =  MathProblem::create([
                'problem_statement' => $problemData['problem_statement'],
                'solution' => $problemData['solution'],
                'image_path' => $problemData['image_path'],
                'equation' =>$problemData['equation'],
                'assignment_set_id' =>$assignmentSet['id'],
            ]);
            
            
            
            // Create an assignment for each student for this problem
            foreach ($students as $student) {
                Assignment::create([
                    'student_id' => $student->id,
                    'math_problem_id' => $problem->id,
                    'status' => 'not_generated',  // Set the initial status
                    'student_solution'=>'',
                ]);
            }
        }
        }
    }
}