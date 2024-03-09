<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Game;
use App\Models\Tag;

class GameTagsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $file = fopen(database_path('seeders/csvfiles/games_tags.csv'), 'r');
        $data = fgetcsv($file);

        while (($data = fgetcsv($file)) !== false) {
            $game = Game::where('name', $data[0])->first();
            $tag = Tag::where('name', $data[1])->first();
            $game->tags()->attach($tag);
        }
    }
}
