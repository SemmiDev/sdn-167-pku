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
        Schema::create('pengaduan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_kategori')->constrained('kategori_pengaduan');
            $table->string('nama'); // nama orang tua / pengadu
            $table->string('wa');
            $table->text('foto');
            $table->text('keterangan')->nullable();
            $table->date('tanggal_kejadian')->nullable(true);
            $table->time('jam_kejadian')->nullable(true);
            $table->longText('sanksi')->nullable(true);
            $table->longText('penyelesaian')->nullable(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengaduan');
    }
};
