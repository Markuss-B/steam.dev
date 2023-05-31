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
        $distributorsDates = [];
        $file = fopen(database_path('seeders/csvfiles/distributors_founding_dates.csv'), 'r');
        fgetcsv($file); // Skip the first row (header)
        while (($data = fgetcsv($file)) !== FALSE) {
            $distributorsDates[$data[0]] = $data[1];
        }
        fclose($file);
    
        $file = fopen(database_path('seeders/csvfiles/merged_steam_data.csv'), 'r');
        fgetcsv($file); // Skip the first row (header)
        while (($data = fgetcsv($file)) !== FALSE) {
            $distributorNames = explode(", ", $data[5]); // Split the distributors string into an array

            foreach ($distributorNames as $distributorName) {
                $distributorFoundingDate = array_key_exists($distributorName, $distributorsDates) 
                    ? ($distributorsDates[$distributorName] !== 'NULL' ? $distributorsDates[$distributorName] : null)
                    : null;
                
                // Check if a distributor with the same name already exists
                if (!Distributor::where('name', $distributorName)->exists()) {
                    // Now you can create the Distributor
                    Distributor::create([
                        'name' => $distributorName,
                        'founded_at' => $distributorFoundingDate,
                        'description' => '',
                    ]);
                }
            }
        }
        fclose($file);
    }
    
    
}
