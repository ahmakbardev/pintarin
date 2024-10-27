<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('judul', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Foreign key ke tabel users
            $table->string('judul'); // Kolom untuk menyimpan judul PTK
            $table->string('status')->default('pending'); // Status (pending, approved, rejected)
            $table->text('catatan')->nullable(); // Catatan revisi
            $table->timestamps();
            $table->softDeletes(); // Menambahkan soft delete

            // Relasi foreign key
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('judul');
    }
};
