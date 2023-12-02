<?php

use Illuminate\Database\Seeder;

class JenisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tbl_jenis')->insert([
            [
                'name' => 'Pemasukan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Pengeluaran',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
