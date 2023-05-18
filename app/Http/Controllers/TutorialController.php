<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TutorialController extends Controller
{
    public function index()
    {
        return view('tutorial.tutorial');
    }

}
