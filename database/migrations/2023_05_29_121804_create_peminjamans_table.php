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
        Schema::create('peminjamans', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('buku_id')->unsigned();
            $table->date('tanggal_mulai_peminjaman')->nullable();
            $table->date('tanggal_pengajuan_peminjaman');
            $table->integer('durasi_peminjaman');
            $table->date('tanggal_pengembalian')->nullable();
            $table->char('status_peminjaman', 1)->default('2');
            $table->text('keterangan')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')
            ->onUpdate('cascade')
            ->onDelete('restrict');
            $table->foreign('buku_id')->references('id')->on('bukus')
            ->onUpdate('cascade')
            ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjamans');
    }
};
