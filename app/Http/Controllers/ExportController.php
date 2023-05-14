<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use League\Csv\Writer;
use Symfony\Component\DomCrawler\Crawler;

class ExportController extends Controller
{
    public function export()
    {
        // Create a new CSV writer instance
        $csv = Writer::createFromFileObject(new \SplTempFileObject());

        // Add the table headers to the CSV
        $csv->insertOne([
            __('studentDetails.points'),
            __('studentDetails.isSub'),
            __('studentDetails.answer'),
            __('studentDetails.isCorrect'),
            __('studentDetails.points')
        ]);

        $students = User::where('role', 'student')
            // Add your relationships and aggregates here
            ->get()
            ->each(function ($student) {
                $student->generated_equations_count = $student->assignments()->where('status', 'generated')->count();
                $student->submitted_equations_count = $student->assignments()->whereIn('status', ['submitted_100', 'submitted_0'])->count();
                // calculate points
                $student->points = $student->assignments()->where('status', 'submitted_100')->get()->sum(function ($assignment) {
                    return $assignment->mathProblem->assignmentSet->points;
                });
            });
        // Fetch the table rows using JavaScript
        $html = view('teacher.students', compact('students'))->render(); // Replace 'table' with the actual view file name

        $crawler = new Crawler($html);
        $rows = $crawler->filter('#studentTable tbody tr')->each(function (Crawler $row) {
            $data = [];

            $row->filter('td')->each(function (Crawler $cell) use (&$data) {
                $data[] = $cell->text();
            });

            return $data;
        });

        // Add the table rows to the CSV
        foreach ($rows as $row) {
            $csv->insertOne($row);
        }

        // Set the response headers
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="table.csv"',
        ];

        // Generate and return the CSV file
        return response($csv->getContent(), 200, $headers);
    }





}

