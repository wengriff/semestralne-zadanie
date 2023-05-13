<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Http\Controllers\AssignmentController;
use App\Models\AssignmentSet;

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
            'assignments' => $mathProblems,  // If you still need the $assignments variable in the view
            'assignmentsGroupedBySet' => $assignmentsGroupedBySet
        ]);
        } else if ($role == 'teacher') {
            $assignmentSetsResult = (new AssignmentController())->assignmentSets();
            $indexResult->with('assignmentSets', $assignmentSetsResult->getData()['assignmentSets']);
        }

    return $indexResult;
}else{
    return view('auth.register');
}
}


}
