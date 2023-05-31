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
        $developersDates = [];
        $file = fopen(database_path('seeders/csvfiles/developers_founding_dates.csv'), 'r');
        fgetcsv($file); // Skip the first row (header)
        while (($data = fgetcsv($file)) !== FALSE) {
            $developersDates[$data[0]] = $data[1];
        }
        fclose($file);
    
        $file = fopen(database_path('seeders/csvfiles/merged_steam_data.csv'), 'r');
        fgetcsv($file); // Skip the first row (header)
        while (($data = fgetcsv($file)) !== FALSE) {
            $developerNames = explode(", ", $data[4]); // Split the developers string into an array

            foreach ($developerNames as $developerName) {
                $developerFoundingDate = array_key_exists($developerName, $developersDates) 
                    ? ($developersDates[$developerName] !== 'NULL' ? $developersDates[$developerName] : null)
                    : null;
                
                // Check if a developer with the same name already exists
                if (!Developer::where('name', $developerName)->exists()) {
                    // Now you can create the Developer
                    Developer::create([
                        'name' => $developerName,
                        'founded_at' => $developerFoundingDate,
                        'description' => '',
                    ]);
                }
            }

        }
        fclose($file);
    }
    
}
