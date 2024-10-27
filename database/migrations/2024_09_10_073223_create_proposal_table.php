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
        Schema::create('proposal', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('judul_id'); // Foreign key ke tabel judul
            $table->string('file_path'); // Path berkas proposal
            $table->string('status')->default('pending'); // Status proposal
            $table->text('catatan')->nullable(); // Catatan revisi
            $table->timestamps();
            $table->softDeletes(); // Menambahkan soft delete

            // Relasi foreign key ke tabel judul
            $table->foreign('judul_id')->references('id')->on('judul')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('proposal');
    }
};
