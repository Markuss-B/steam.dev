<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $file = fopen(database_path('seeders/csvfiles/tags.csv'), 'r');
        $data = fgetcsv($file);

        while (($data = fgetcsv($file)) !== false) {
            Tag::create([
                'name' => $data[0],
            ]);
        }
    }
}
