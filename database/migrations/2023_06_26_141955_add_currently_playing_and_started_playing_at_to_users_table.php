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
        if (Schema::hasColumn('users', 'currently_playing')) {
            return;
        }
        Schema::table('users', function (Blueprint $table) {
            $table->integer('currently_playing')->nullable();
            $table->timestamp('started_playing_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('currently_playing');
            $table->dropColumn('started_playing_at');
        });
    }
};
