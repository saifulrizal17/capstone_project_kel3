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
        Schema::create('tbl_catatan_keuangans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_user')->nullable();
            $table->unsignedBigInteger('id_jenis')->nullable();
            $table->unsignedBigInteger('id_kategori')->nullable();
            $table->date('tanggal_transaksi')->nullable();
            $table->decimal('jumlah', 15, 2)->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();

            $table->foreign('id_user')->references('id')->on('tbl_users')->onDelete('cascade');
            $table->foreign('id_jenis')->references('id')->on('tbl_jenis_catatan_keuangans')->onDelete('cascade');
            $table->foreign('id_kategori')->references('id')->on('tbl_kategori_catatan_keuangans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_catatan_keuangans');
    }
}
