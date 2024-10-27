<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('saling_review_chats', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('progress_id'); // ID untuk menyimpan ID progress tugas yang terkait
            $table->unsignedBigInteger('user_id'); // ID user pengirim pesan
            $table->text('message'); // Kolom untuk menyimpan pesan chat
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('progress_id')->references('id')->on('tugas_progress')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('saling_review_chats');
    }
};
