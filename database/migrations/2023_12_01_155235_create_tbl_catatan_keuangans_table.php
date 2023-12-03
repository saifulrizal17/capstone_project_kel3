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
            $table->unsignedBigInteger('id_user')->nullable();
            $table->foreign('id_user')->references('id')->on('tbl_users')->onDelete('cascade');
            $table->unsignedBigInteger('id_jenis')->nullable();
            $table->foreign('id_jenis')->references('id')->on('tbl_jenis')->onDelete('cascade');
            $table->unsignedBigInteger('id_kategori')->nullable();
            $table->foreign('id_kategori')->references('id')->on('tbl_kategori')->onDelete('cascade');
            $table->date('tanggal_transaksi')->nullable();
            $table->decimal('jumlah', 15, 2)->nullable();
            $table->text('keterangan')->nullable();
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
