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
                'role_id' => 1,
                'deskripsi' => 'Administrator',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'role_id' => 2,
                'deskripsi' => 'User',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
