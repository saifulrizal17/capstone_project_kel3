<?php

use Illuminate\Database\Seeder;

class PerubahanModalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tbl_perubahan_modal')->insert([
            [
                'id_user' => 2,
                'tanggal_perubahan' => now(),
                'jumlah' => 50000.00,
                'keterangan' => 'Perubahan modal awal',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_user' => 2,
                'tanggal_perubahan' => now(),
                'jumlah' => 75000.00,
                'keterangan' => 'Penambahan modal',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
