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
        Schema::create('product_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_header')->constrained('product_headers')->onDelete('restrict'); //foreign key dari table product_headers
            $table->unsignedBigInteger('id_warna'); //foreign key dari table warna
            $table->integer('current_stock');
            $table->string('kode_barang');
            $table->timestamps();

            // Define the foreign key relationship
            // $table->foreign('id_header')->references('id')->on('product_headers')->onDelete('restrict');
            // Define the foreign key relationship
            $table->foreign('id_warna')->references('id')->on('warnas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_details');
    }
};
