<?php

use Illuminate\Database\Seeder;

class LabaRugisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tbl_labarugis')->insert([
            [
                'id_user' => 2,
                'pendapatan' => 5000000.00,
                'pengeluaran' => 2250000.00,
                'bulan' => '2023-09-01', // September 2023
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_user' => 2,
                'pendapatan' => 15000000.00,
                'pengeluaran' => 7500000.00,
                'bulan' => '2023-10-01', // Oktober 2023
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_user' => 2,
                'pendapatan' => 10000000.00,
                'pengeluaran' => 8000000.00,
                'bulan' => '2023-11-01', // November 2023
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_user' => 2,
                'pendapatan' => 6000000.00,
                'pengeluaran' => 5000000.00,
                'bulan' => '2023-12-01', // December 2023
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
