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
        Schema::create('bukus', function (Blueprint $table) {
            $table->id();
            $table->string('sampul')->nullable();
            $table->string('judul')->nullable();
            $table->text('deskripsi')->nullable();
            $table->string('pengarang')->nullable();
            $table->string('impresium')->nullable();
            $table->string('kolasi')->nullable();
            $table->bigInteger('isbn_issn')->nullable();
            $table->string('no_inventaris')->nullable();
            $table->string('prefix');
            $table->integer('length_code')->default(5);
            $table->integer('jumlah')->default(0);
            $table->string('bahasa')->nullable();
            $table->string('prodi')->nullable();
            $table->string('lokasi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bukus');
    }
};
