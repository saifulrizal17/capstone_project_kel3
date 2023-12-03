<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblNeracaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_neraca', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_user')->nullable();
            $table->decimal('aset', 15, 2)->nullable();
            $table->decimal('kewajiban', 15, 2)->nullable();
            $table->decimal('ekuitas', 15, 2)->nullable();
            $table->date('bulan')->nullable();
            $table->timestamps();

            $table->foreign('id_user')->references('id')->on('tbl_users')->onDelete('cascade');
        });

        // Schema::create('tbl_neraca', function (Blueprint $table) {
        //     $table->bigInteger('id')->unsigned();  
        //     $table->unsignedBigInteger('id_user')->nullable();
        //     $table->decimal('aset', 15, 2)->nullable();
        //     $table->decimal('kewajiban', 15, 2)->nullable();
        //     $table->decimal('ekuitas', 15, 2)->nullable();
        //     $table->year('bulan')->nullable();
        //     $table->timestamp('created_at')->default(now());
        //     $table->timestamp('updated_at')->default(now())->onUpdate(now());

        //     $table->primary('id');
        // });


        // Schema::table('tbl_neraca', function (Blueprint $table) {
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
        Schema::dropIfExists('tbl_neraca');
    }
}
