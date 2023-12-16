<?php

use Illuminate\Database\Seeder;

class UsersRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tbl_users_roles')->insert([
            [
                'name' => 'Admin',
                'description' => 'Administrator',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'User',
                'description' => 'Pengguna',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
