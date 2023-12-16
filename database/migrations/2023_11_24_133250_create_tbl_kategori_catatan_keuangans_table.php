<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblKategoriCatatanKeuangansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_kategori_catatan_keuangans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_jenis');
            $table->string('name');
            $table->string('description', 500);
            $table->timestamps();

            $table->foreign('id_jenis')->references('id')->on('tbl_jenis_catatan_keuangans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_kategori_catatan_keuangans');
    }
}
