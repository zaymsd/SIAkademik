<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
       Schema::create('mahasiswas', function (Blueprint $table) {
        $table->id('id_mahasiswa'); 
        $table->string('nim');
        $table->string('nama');
        
        // Mendefinisikan Foreign Key secara eksplisit
        $table->unsignedBigInteger('id_jurusan');
        $table->foreign('id_jurusan')->references('id_jurusan')->on('jurusans')->onDelete('cascade');
        
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mahasiswas');
    }
};
