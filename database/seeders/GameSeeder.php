<?php

namespace Database\Seeders;

use App\Models\Developer;
use App\Models\Publisher;
use App\Models\Game;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $file = fopen('database\seeders\csvfiles\games.csv', 'r');
        $data = fgetcsv($file);

        while (($data = fgetcsv($file)) !== false) {
            Game::create([
                'name' => $data[0],
                'description' => $data[4],
                'price' => $data[2],
                'discount' => $data[3],
                'release_date' => ($data[1] === 'NULL' || $data[1] === '') ? null : $data[1], // Convert 'NULL' to null (nullable date
            ]);
        }
    }
}


