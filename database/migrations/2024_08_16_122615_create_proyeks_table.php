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
        Schema::create('proyeks', function (Blueprint $table) {
            $table->id();
            $table->string('nama_proyek');
            $table->foreignId('category_proyek_id')->constrained('category_proyeks')->cascadeOnDelete();
            $table->bigInteger('biaya_proyek');
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->enum('status_proyek', ['belum', 'sedang-berjalan', 'selesai']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proyeks');
    }
};
