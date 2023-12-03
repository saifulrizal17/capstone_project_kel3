<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tbl_users_role')->insert([
            [
                'name' => 'Admin',
                'deskripsi' => 'Administrator',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'User',
                'deskripsi' => 'Pengguna',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
