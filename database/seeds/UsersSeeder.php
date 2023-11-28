<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tbl_users')->insert([
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'phone_number' => '123456789',
                'job_title' => 'Administrator',
                'address' => 'Admin Address',
                'email_verified_at' => now(),
                'password' => Hash::make('12345678'),
                'role_id' => 1,
                'is_active' => true,
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Regular User',
                'email' => 'user@gmail.com',
                'phone_number' => '987654321',
                'job_title' => 'Regular Job',
                'address' => 'User Address',
                'email_verified_at' => now(),
                'password' => Hash::make('12345678'),
                'role_id' => 2,
                'is_active' => true,
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
