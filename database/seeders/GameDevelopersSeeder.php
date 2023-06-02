<?php

namespace Database\Seeders;

use App\Models\Game;
use App\Models\Developer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GameDevelopersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $file = fopen(database_path('seeders/csvfiles/games_developers.csv'), 'r');
        fgetcsv($file); // Skip the first row (header)

        while (($data = fgetcsv($file)) !== false) {
            $game = Game::where('name', $data[0])->first();
            $developer = Developer::where('name', $data[1])->first();
            $game->developers()->attach($developer->id);
        }
    }
}
