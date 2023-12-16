<?php

use Illuminate\Database\Seeder;

class NeracasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tbl_neracas')->insert([
            [
                'id_user' => 2,
                'aset' => 100000000.00,
                'kewajiban' => 15000000.00,
                'ekuitas' => 50000000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
