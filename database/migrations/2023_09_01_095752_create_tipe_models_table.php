<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipe_models', function (Blueprint $table) {
            $table->id();
            $table->string('kode_model')->unique();
            $table->string('nama_model');            
            $table->string('deskripsi')->nullable();
            $table->unsignedBigInteger('id_jenis'); //foreign key dari table jenis
            $table->timestamps();

            // Define the foreign key relationship
            $table->foreign('id_jenis')->references('id')->on('jenis')->onDelete('cascade');
        });

        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tipe_models');
    }
};
