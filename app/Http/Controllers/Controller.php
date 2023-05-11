<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Http\Controllers\AssignmentController;

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
    // Call the index() method
    $indexResult = $this->index();

    // Call the assignmentSets() method from the AssignmentController
    $assignmentSetsResult = (new AssignmentController())->assignmentSets();

    // Combine the results as needed
    // For example, if you want to pass the $assignmentSets variable from the AssignmentController to the view returned by the index() method:
    $indexResult->with('assignmentSets', $assignmentSetsResult->getData()['assignmentSets']);

    return $indexResult;
}

}
