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
        Schema::table('game_user', function (Blueprint $table) {
            $table->integer('purchase_cost')->after('acquisition_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('game_user', function (Blueprint $table) {
            $table->dropColumn('purchase_cost');
        });
    }
};
