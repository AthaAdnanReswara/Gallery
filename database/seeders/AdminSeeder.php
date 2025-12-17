<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //cek apakah admin sudah ada
        if(!User::where('role','admin')->exists()) {
            User::create([
                'name' => 'Administrator',
                'email' => 'admin@woka.com',
                'password' => Hash::make('123'),
                'role' => 'admin',
            ]);
        }
        // //cek apakah admin sudah ada 
        // if(!User::where('role','adnan')->exists()) {
        //     User::create([
        //         'name' => 'Atha Adnan Reswara',
        //         'email' => 'athaadnanreswara@gmail.com',
        //         'password' => Hash::make('123'),
        //         'role' => 'adnan'
        //     ]);
        // }
    }
}
