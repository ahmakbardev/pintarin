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
        Schema::table('users', function (Blueprint $table) {
            $table->string('nim')->unique()->after('email');
            $table->foreignId('dosen_id')->after('nim')->constrained('dosens')->onDelete('cascade');
            $table->string('profile_pic')->nullable()->after('password');
            $table->text('bio')->nullable()->after('profile_pic');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['dosen_id']);
            $table->dropColumn(['nim', 'dosen_id', 'profile_pic', 'bio']);
        });
    }
};
