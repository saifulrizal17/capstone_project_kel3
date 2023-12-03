<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblPerubahanModalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_perubahan_modal', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_user')->nullable();
            $table->date('tanggal_perubahan')->nullable();
            $table->decimal('jumlah', 15, 2)->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();

            $table->foreign('id_user')->references('id')->on('tbl_users')->onDelete('cascade');
        });

        // Schema::create('tbl_perubahan_modal', function (Blueprint $table) {
        //     $table->unsignedBigInteger('id')->primary(); 
        //     $table->bigInteger('id_user')->unsigned()->nullable();
        //     $table->date('tanggal_perubahan')->nullable();
        //     $table->text('keterangan')->nullable();
        //     $table->decimal('jumlah', 15, 2)->nullable();
        //     $table->timestamps();

        //     $table->foreign('id_user')->references('id')->on('tbl_users')->onDelete('cascade');

        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_perubahan_modal');
    }
}
