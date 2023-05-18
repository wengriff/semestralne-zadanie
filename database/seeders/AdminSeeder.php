<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'surname' => 'Admin',
            'email' => 'admin@semestralneZadanie.com',
            'password' => Hash::make('adminadmin'),
            'role' => 'admin',
        ]);
    }
}