<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Http\Controllers\AssignmentController;
use App\Models\AssignmentSet;
use App\Models\Assignment;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Models\User;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function index() {
        $role = null;
        if(auth()->check()) {
            $role = auth()->user()->role;
        }

        return view('home.index', compact('role'));
    }

    public function dashboard()
    {
        $indexResult = $this->index();
        $role=null;
        if(auth()->check()) {
            $role = auth()->user()->role;
        

        
            if ($role == 'student') {
                $mathProblems = auth()->user()->mathProblems()->with('assignmentSet')->get();
                $assignmentsGroupedBySet = $mathProblems->groupBy(function ($item, $key) {
                return $item->assignmentSet->id;
        });

        return $indexResult->with([
            'assignments' => $mathProblems,  
            'assignmentsGroupedBySet' => $assignmentsGroupedBySet
        ]);
        } else if ($role == 'teacher') {
            $assignmentSetsResult = (new AssignmentController())->assignmentSets();
            $indexResult->with('assignmentSets', $assignmentSetsResult->getData()['assignmentSets']);
        }else if($role == 'admin'){
            $users = User::where('role', '<>', 'admin')->get(); 
            return $indexResult->with('users', $users);
        }

    return $indexResult;
}else{
    return view('auth.register');
}
}

public function store(Request $request)
{
    $user = auth()->user();

    $problemId = $request->input('problemId');
    $solution = $request->input('solution');
    
    // Retrieve the assignment based on the problem ID
    $assignment = Assignment::where('student_id', $user->id)->where('math_problem_id', $problemId)->first();

    // Update the student_solution field
    $assignment->update([
        'student_solution' => $solution
    ]);
     // Prepare the data to be sent as JSOn

     $data = [
        'expr1' => $assignment->mathProblem->solution,
        'expr2' => $solution
    ];

    // Send a POST request to the specified URL with the JSON data
    $response = Http::withOptions(['verify' => false])->post('https://site216.webte.fei.stuba.sk:9001/compare', $data);

      // You can check the response status and body like this:
    if($response->successful()){
        // The request was successful...
        $responseBody = json_decode($response->body());

        if($responseBody->result == 1) {
            $assignment->update(['status' => 'submitted_100']);
        } else {
            $assignment->update(['status' => 'submitted_0']);
        }
    }
    

    // Redirect the user back to the page, or to another page
    return redirect()->route('dashboard');
}
public function updateRole(Request $request, User $user)
{
    $validatedData = $request->validate([
        'role' => 'required|in:student,teacher',
    ]);

    $user->update($validatedData);

    return redirect()->back()->with('success', 'Role updated successfully!');
}

}
