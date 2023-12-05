<?php

use Illuminate\Database\Seeder;

class LabaRugiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tbl_labarugi')->insert([
            [
                'id_user' => 2,
                'pendapatan' => 100000.00,
                'pengeluaran' => 50000.00,
                'bulan' => '2023-11-01', // November 2023
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_user' => 2,
                'pendapatan' => 150000.00,
                'pengeluaran' => 75000.00,
                'bulan' => '2023-12-01', // December 2023
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
