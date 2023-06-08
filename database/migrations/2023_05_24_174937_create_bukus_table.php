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
            $table->string('nama_buku')->unique();
            $table->bigInteger('kategori_id')->unsigned();
            $table->bigInteger('tempat_buku_id')->unsigned();
            $table->string('sampul_buku')->nullable();
            $table->char('status_tersedia',1)->default('1');
            $table->timestamps();
            $table->foreign('kategori_id')->references('id')->on('kategoris')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('tempat_buku_id')->references('id')->on('tempat_bukus')->onDelete('restrict')->onUpdate('cascade');
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
