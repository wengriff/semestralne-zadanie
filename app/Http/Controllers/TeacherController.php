<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class TeacherController extends Controller
{
    public function students()
    {
        $students = User::where('role', 'student')
                        // Add your relationships and aggregates here
                        ->get();

        return view('teacher.students', compact('students'));
    }

    public function studentDetails($id)
    {
        $student = User::where('role', 'student')
                       // Add your relationships here
                       ->findOrFail($id);

        return view('teacher.student_details', compact('student'));
    }
}
