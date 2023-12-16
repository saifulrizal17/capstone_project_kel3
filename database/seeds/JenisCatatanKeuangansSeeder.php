<?php

use Illuminate\Database\Seeder;

class JenisCatatanKeuangansSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tbl_jenis_catatan_keuangans')->insert([
            [
                'name' => 'Pemasukan',
                'description' => 'Pendapatan adalah jumlah uang atau nilai ekonomi lainnya yang diterima atau diperoleh oleh individu, bisnis, atau organisasi dari berbagai sumber. Pendapatan dapat berasal dari penjualan produk atau jasa, investasi, upah atau gaji, sewa, royalti, atau sumber-sumber lainnya.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Pengeluaran',
                'description' => 'Pengeluaran merujuk pada penggunaan uang atau sumber daya ekonomi lainnya oleh individu, bisnis, atau organisasi. Pengeluaran dapat terjadi dalam berbagai bentuk, termasuk pembelian barang dan jasa, pembayaran gaji, biaya operasional, investasi, atau pembayaran utang.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
