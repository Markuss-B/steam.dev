<?php

namespace Database\Seeders;

use App\Models\Game;
use App\Models\Publisher;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GamePublishersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $file = fopen(database_path('seeders/csvfiles/games_publishers.csv'), 'r');
        fgetcsv($file); // Skip the first row (header)

        while (($data = fgetcsv($file)) !== false) {
            $game = Game::where('name', $data[0])->first();
            $publisher = Publisher::where('name', $data[1])->first();
            $game->publishers()->attach($publisher->id);
        }
    }
}
