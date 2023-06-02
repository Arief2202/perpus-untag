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
        Schema::create('keanggotaans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_keanggotaan');
            $table->integer('max_pinjam')->default(10);
            $table->integer('masa_aktif_pinjam')->default(10);
            $table->integer('denda_per_hari')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keanggotaans');
    }
};
