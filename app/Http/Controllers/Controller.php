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
    $indexResult = $this->index();
    $assignmentSetsResult = (new AssignmentController())->assignmentSets();
    $indexResult->with('assignmentSets', $assignmentSetsResult->getData()['assignmentSets']);
    return $indexResult;
    }


}
