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
        Schema::create('pelayanans', function (Blueprint $table) {
            $table->id();
            $table->integer('antrian');
            $table->enum('penjamin', ['umum', 'bpjs']);
            $table->string('nama')->unique();
            $table->enum('jk', ['L', 'P']);
            $table->date('tanggal');
            $table->string('nik');
            $table->foreignId('poliklinik_id');
            $table->integer('status')->nullable();
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
        Schema::dropIfExists('pelayanans');
    }
};
