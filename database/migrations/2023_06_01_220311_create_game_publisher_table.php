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
        Schema::create('game_publisher', function (Blueprint $table) {
            $table->foreignId('game_id')->constrained('games');
            $table->foreignId('publisher_id')->constrained('publishers');
            $table->primary(['game_id', 'publisher_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('game_publisher');
    }
};
