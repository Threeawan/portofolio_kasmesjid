<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeders extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name'=>'Tryawan',
            'username'=>'Mochamad Tryawan',
            'role'=>'Admin',
            'email'=>'mochamadtryawan@gmail.com',
            'password'=>Hash::make('123456'),
        ]);
    }
}
