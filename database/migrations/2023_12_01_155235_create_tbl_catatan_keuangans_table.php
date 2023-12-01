<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblCatatanKeuangansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_catatan_keuangan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_user')->unsigned()->nullable();
            $table->date('tanggal_transaksi')->nullable();
            $table->decimal('jumlah', 15, 2)->nullable();
            $table->text('keterangan')->nullable();
            $table->enum('jenis', ['pemasukan', 'pengeluaran'])->default('pengeluaran');
            $table->string('kategori')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_catatan_keuangan');
    }
}
