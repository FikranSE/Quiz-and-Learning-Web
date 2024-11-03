<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIlustrasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ilustrasis', function (Blueprint $table) {
            $table->id();
            $table->string('ilustrasi'); // Nama file ilustrasi
            $table->string('tujuan_pbl'); // Tujuan PBL (ini bisa diubah sesuai kebutuhan)
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
        Schema::dropIfExists('ilustrasis');
    }
}