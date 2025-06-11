<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'id' => 1,
                'name' => 'SuperAdmin',
                'email' => 'lynn211025@gmail.com',
                'email_verified_at' => '2025-05-16 01:54:53',
                'password' => '$2y$12$WCKNIDpsM3pmLZ4xwfm60eHw9/7oyfmCVPddG0820fNwqhUdLRqHG',
                'remember_token' => '697uy8rHgl',
                'created_at' => '2025-05-16 01:54:53',
                'updated_at' => '2025-05-16 01:54:53',
                'deleted_at' => null,
            ],
           
        ]);
    }
}
