<?php

namespace Database\Seeders;

use App\Models\Distributor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DistributorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $file = fopen('database\seeders\csvfiles\distributors_founding_dates.csv', 'r');
        $data = fgetcsv($file);

        while (($data = fgetcsv($file)) !== false) {
            Distributor::create([
                'name' => $data[0],
                'founded_at' => $data[1] != ' NULL' ? $data[1] : null,
                'description' => '',
            ]);
        }

        fclose($file);
    }
}
