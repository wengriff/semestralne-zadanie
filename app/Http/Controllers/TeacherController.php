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
                        // Add your relationships and aggregates her
                        ->get()
                        ->each(function ($student) {
                            $student->generated_equations_count = $student->assignments()->where('status', 'generated')->count();
                            $student->submitted_equations_count = $student->assignments()->whereIn('status', ['submitted_100', 'submitted_0'])->count();
                        // calculate points
                        $student->points = $student->assignments()->where('status', 'submitted_100')->get()->sum(function ($assignment) {
                            return $assignment->mathProblem->assignmentSet->points;
                        });
                    });

        return view('teacher.students', compact('students'));
    }

    public function studentDetails($id)
    {
        $student = User::where('role', 'student')
        ->with(['assignments.mathProblem'])
        ->findOrFail($id);

        return view('teacher.students_details', compact('student'));
    }
}
