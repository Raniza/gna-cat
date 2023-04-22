<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tools\MasterTool as Tool;

class MasterToolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Tool::truncate();
        // database\seeders\Master.csv
        $a = 0;
        $csvFile = fopen(base_path("database/seeders/data/Master.csv"), "r");
        $firstline = true;
        while (($data = fgetcsv($csvFile, 2000, ";")) !== false) {
            $a += 1;
            $date = strtotime('+' . $a . 'day', strtotime('2020-10-25 11:25:33'));
            if (!$firstline) {
                Tool::create([
                    'code' => $data['0'],
                    'desc' => strval($data['1']),
                    'created_at' => $date,
                    'updated_at' => $date,
                    // 'drawing' => $data['2'],
                ]);
            }
            $firstline = false;
        }
        fclose($csvFile);
    }
}
