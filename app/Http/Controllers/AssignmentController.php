<?php

namespace App\Http\Controllers;

use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AssignmentSet;
use App\Models\Assignment;
use Illuminate\Support\Facades\Http;


class AssignmentController extends Controller
{
    public function assignmentSets()
    {

        $assignmentSets = AssignmentSet::all();

        return view('home.index', compact('assignmentSets'));
    }

    public function edit($id)
    {
    $assignmentSet = AssignmentSet::find($id);
    return view('assignment.edit', compact('assignmentSet'));
    }

    public function update(Request $request, $id)
{
    $assignmentSet = AssignmentSet::find($id);
    $assignmentSet->starting_date = $request->starting_date;
    $assignmentSet->deadline = $request->deadline;
    $assignmentSet->points = $request->points;
    // Update other fields
    $assignmentSet->save();

    return view('assignment.show', compact('assignmentSet'));

}
public function updateStatus(Request $request) {
    // Get the assignment from the pivot table
    $assignment = Assignment::where('student_id', auth()->user()->id)
                            ->where('math_problem_id', $request->problem_id)
                            ->first();

    // Update the status
    $assignment->status = 'generated';
    $assignment->save();

    // Send back a response
    return response()->json(['success' => true]);
}
public function getImage($problemId)
{
    // Find the assignment based on the problem ID
    $assignment = Assignment::find($problemId);

    // Generate the image HTML based on the assignment data
    $imageHtml = '<div class="row">';
    $imageHtml .= '<div class="col-md-6">';
    $imageHtml .= '<img class="img-fluid" src="' . asset('storage/images/' . $assignment->image_path) . '" alt="Problem Image">';
    $imageHtml .= '</div>';
    $imageHtml .= '<div class="col-md-6">';
    // Add your logic to generate additional HTML based on the assignment status
    // ...
    $imageHtml .= '</div>';
    $imageHtml .= '</div>';

    // Return the image HTML as a response
return response($imageHtml);
}
public function show($id)
{
    $assignment = Assignment::find($id);
    // replace 'show' with the correct view name
    return view('assignments.show', compact('assignment'));
}

public function solve($problemId)
{
    // Retrieve the assignment based on the problem ID
    $assignment = Assignment::with('mathProblem')->find($problemId);

    // Pass the assignment data to the solve view
    return view('student.solve', ['assignment' => $assignment]);
    
}



}
