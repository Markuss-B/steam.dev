<?php

namespace Database\Seeders;

use App\Models\Developer;
use App\Models\Distributor;
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
        $file = fopen('database\seeders\csvfiles\merged_steam_data.csv', 'r');
        $data = fgetcsv($file);

        while (($data = fgetcsv($file)) !== false) {
            $developer = Developer::where('name', $data[4])->first();
            $distributor = Distributor::where('name', $data[5])->first();
            $date = json_decode($data[3], true);
            if (isset($date['date'])) {
                $date = $date['date'];
                $date = Carbon::createFromFormat('j M, Y', $date);
            } else {
                $date = null;
            }
            
            Game::create([
                'name' => $data[1],
                'description' => $data[2],
                'price' => $data[6],
                'discount' => $data[7],
                'release_date' => $date,
                'developer_id' => $developer->id,
                'distributor_id' => $distributor->id,
            ]);
        }

        fclose($file);
    }
}
