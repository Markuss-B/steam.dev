<?php

namespace Database\Seeders;

use App\Models\Publisher;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PublisherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $file = fopen(database_path('seeders/csvfiles/publishers.csv'), 'r');
        fgetcsv($file); // Skip the first row (header)

        while (($data = fgetcsv($file)) !== false) {
            Publisher::create([
                'name' => $data[0],
                'founded_at' => ($data[1] === 'NULL' || $data[1] === '') ? null : $data[1], // Convert 'NULL' to null (nullable date
                'description' => '',
            ]);
        }

    }
    
    
}
