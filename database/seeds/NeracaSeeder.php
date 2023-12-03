<?php

use Illuminate\Database\Seeder;

class NeracaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tbl_neraca')->insert([
            [
                'id_user' => 2,
                'aset' => 100000.00,
                'kewajiban' => 50000.00,
                'ekuitas' => 50000.00,
                'bulan' => '2023-12-01', // December 2023
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_user' => 2,
                'aset' => 150000.00,
                'kewajiban' => 75000.00,
                'ekuitas' => 75000.00,
                'bulan' => '2023-12-01', // December 2023
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
