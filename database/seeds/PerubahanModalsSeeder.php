<?php

use Illuminate\Database\Seeder;

class PerubahanModalsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tbl_perubahan_modals')->insert([
            [
                'id_user' => 2,
                'id_jenis' => 1,
                'tanggal_perubahan' => now(),
                'jumlah' => 100000000.00,
                'keterangan' => 'Rumah didaerah Solo',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_user' => 2,
                'id_jenis' => 2,
                'tanggal_perubahan' => now(),
                'jumlah' => 15000000.00,
                'keterangan' => 'Kredit Mobil Operasional',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_user' => 2,
                'id_jenis' => 3,
                'tanggal_perubahan' => now(),
                'jumlah' => 50000000.00,
                'keterangan' => 'Saham PT Atmasuka',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
