<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users_data = [
            [
                'name' => 'Christiant Dimas Renggana',
                'email' => 'dimasrenggana06@gmail.com',
                'password' => Hash::make('password'),
                'role' => 'teacher',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Guru',
                'email' => 'guru@gmail.com',
                'password' => Hash::make('password'),
                'role' => 'teacher',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Guru 2',
                'email' => 'demo@demo.com',
                'password' => Hash::make('password'),
                'role' => 'teacher',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ];

        foreach ($users_data as $user_data) {
            User::create($user_data);
        }
    }
}
