<?php

namespace App\Http\Controllers;

use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AssignmentSet;

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
}
