<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LatexFileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(){
   
    $folderPath = storage_path('latex');
    echo $folderPath;
    $files = glob($folderPath . '/blokovka*.tex');

    foreach ($files as $file) {
        $startingDate = '2023-05-12 00:00:00'; // Set the starting date for each file
        $deadline = '2023-05-19 00:00:00'; // Set the deadline for each file
        $points = 10; // Set the points for each file

        DB::table('latex_files')->insert([
            'file_path' => $file,
            'starting_date' => $startingDate,
            'deadline' => $deadline,
            'points' => $points,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
}