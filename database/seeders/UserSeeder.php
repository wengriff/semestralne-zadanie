<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //teachers
        User::create([
            'name' => 'John',
            'surname' => 'Smith',
            'email' => 'JohnSmith@gmail.com',
            'password' => Hash::make('JohnSmith'),
            'role' => 'teacher',
        ]);
        User::create([
            'name' => 'Dwayne',
            'surname' => 'Conner',
            'email' => 'DwayneConner@gmail.com',
            'password' => Hash::make('DwayneConner'),
            'role' => 'teacher',
        ]);
        User::create([
            'name' => 'Olivia',
            'surname' => 'Murphy',
            'email' => 'OliviaMurphy@gmail.com',
            'password' => Hash::make('OliviaMurphy'),
            'role' => 'teacher',
        ]);

        //students
        User::create([
            'name' => 'George',
            'surname' => 'Willson',
            'email' => 'GeorgeWillson@gmail.com',
            'password' => Hash::make('GeorgeWillson'),
            'role' => 'student',
        ]);
        User::create([
            'name' => 'Emily',
            'surname' => 'Brown',
            'email' => 'EmilyBrown@gmail.com',
            'password' => Hash::make('EmilyBrown'),
            'role' => 'student',
        ]);
        User::create([
            'name' => 'Richard',
            'surname' => 'Martin',
            'email' => 'RichardMartin@gmail.com',
            'password' => Hash::make('RichardMartin'),
            'role' => 'student',
        ]);
        User::create([
            'name' => 'Daniel',
            'surname' => 'Evans',
            'email' => 'DanielEvans@gmail.com',
            'password' => Hash::make('DanielEvans'),
            'role' => 'student',
        ]);
        User::create([
            'name' => 'Victoria',
            'surname' => 'Walsh',
            'email' => 'VictoriaWalsh@gmail.com',
            'password' => Hash::make('VictoriaWalsh'),
            'role' => 'student',
        ]);
        User::create([
            'name' => 'Jack',
            'surname' => 'Anderson',
            'email' => 'JackAnderson@gmail.com',
            'password' => Hash::make('JackAnderson'),
            'role' => 'student',
        ]);
        User::create([
            'name' => 'Oscar',
            'surname' => 'White',
            'email' => 'OscarWhite@gmail.com',
            'password' => Hash::make('OscarWhite'),
            'role' => 'student',
        ]);
        User::create([
            'name' => 'Thomas',
            'surname' => 'Davies',
            'email' => 'ThomasDavies@gmail.com',
            'password' => Hash::make('ThomasDavies'),
            'role' => 'student',
        ]);
        User::create([
            'name' => 'Jessica',
            'surname' => 'Taylor',
            'email' => 'JessicaTaylor@gmail.com',
            'password' => Hash::make('JessicaTaylor'),
            'role' => 'student',
        ]);
        User::create([
            'name' => 'David',
            'surname' => 'Charles',
            'email' => 'DavidCharles@gmail.com',
            'password' => Hash::make('DavidCharles'),
            'role' => 'student',
        ]);
        

    }
}
