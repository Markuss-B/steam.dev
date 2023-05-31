<?php

namespace Database\Seeders;

use App\Models\Developer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DeveloperSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $file = fopen('database\seeders\csvfiles\developers_founding_dates.csv', 'r');
        $data = fgetcsv($file);

        while (($data = fgetcsv($file)) !== false) {
            Developer::create([
                'name' => $data[0],
                'founded_at' => $data[1] != ' NULL' ? $data[1] : null,
                'description' => '',
            ]);
        }

        fclose($file);
    }
}
