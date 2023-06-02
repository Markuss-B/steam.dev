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
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('description', 1000)->nullable();
            $table->integer('price');
            $table->integer('discount');
            $table->date('release_date')->nullable();
            $table->timestamps();
            $table->foreignId('developer_id')->nullable()->constrained('developers');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('games');
    }
};
