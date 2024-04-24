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
        Schema::create('perkuliahan', function (Blueprint $table) {
            $table->unsignedMediumInteger('id_perkuliahan')->autoIncrement();
            $table->string('nim', 10);
            $table->string('kode_mk', 10);
            $table->double('nilai');

            $table->foreign('nim')->references('nim')->on('mahasiswa');
            $table->foreign('kode_mk')->references('kode_mk')->on('matakuliah');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perkuliahan');
    }
};
