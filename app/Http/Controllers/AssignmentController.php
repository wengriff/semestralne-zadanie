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
}
