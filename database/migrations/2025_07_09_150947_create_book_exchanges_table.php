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
        Schema::create('book_exchanges', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique(); // Contoh: A01297
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('title');
            $table->string('author');
            $table->string('genre');
            $table->string('language');
            $table->text('condition_description');
            $table->enum('status', ['Menunggu Penilaian', 'Diterima', 'Ditolak'])->default('Menunggu Penilaian');
            $table->text('rejection_reason')->nullable();
            $table->unsignedInteger('awarded_coins')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_exchanges');
    }
};