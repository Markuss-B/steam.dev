<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Staudenmeir\LaravelMergedRelations\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (Schema::hasView('friends_view')) {
            Schema::dropView('friends_view');
        }
        Schema::createMergeView(
            'friends_view',
            [(new User)->acceptedFriendsTo(), (new User)->acceptedFriendsFrom()]
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropView('friends_view'	);
    }
};
