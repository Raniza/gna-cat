<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin\MasterProcess as Process;

class MasterProcessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $process = [
            ['name' => 'Sawing', 'main_process_id' => 1],
            ['name' => 'Shearing', 'main_process_id' => 1],
            ['name' => 'Press #1', 'main_process_id' => 1],
            ['name' => 'Centering', 'main_process_id' => 2],
            ['name' => 'Turning #1', 'main_process_id' => 2],
            ['name' => 'Turning #2', 'main_process_id' => 2],
            ['name' => 'Turning #3', 'main_process_id' => 2],
            ['name' => 'Pin Miller', 'main_process_id' => 2],
            ['name' => 'Oil Hole', 'main_process_id' => 2],
            ['name' => 'Shaper', 'main_process_id' => 2],
            ['name' => 'Mid. Washing #1', 'main_process_id' => 2],
            ['name' => 'Mid. Washing #2', 'main_process_id' => 2],
            ['name' => 'Journal Grinding', 'main_process_id' => 2],
            ['name' => 'Pin Grinding', 'main_process_id' => 2],
            ['name' => 'Angular Grinding', 'main_process_id' => 2],
            ['name' => 'R. Angular Grinding', 'main_process_id' => 2],
            ['name' => 'Coolant Remover', 'main_process_id' => 2],
            ['name' => 'Laser Marking', 'main_process_id' => 2],
            ['name' => 'Straightening', 'main_process_id' => 2],
            ['name' => 'Center Screw', 'main_process_id' => 2],
            ['name' => 'Balance Correction', 'main_process_id' => 2],
            ['name' => 'Paper Lapping', 'main_process_id' => 2],
            ['name' => 'Final Washing', 'main_process_id' => 2],
            ['name' => 'Final Measuring', 'main_process_id' => 2],
            ['name' => 'Final Inspection', 'main_process_id' => 2],
            ['name' => 'Press Fit - SP', 'main_process_id' => 2],
            ['name' => 'Press Fit - GD', 'main_process_id' => 2],
            ['name' => 'Packing', 'main_process_id' => 2],
            ['name' => 'Rough Boring', 'main_process_id' => 2],
            ['name' => 'Fine Boring', 'main_process_id' => 2],
            ['name' => 'Hobing', 'main_process_id' => 2],
            ['name' => 'Key Flute', 'main_process_id' => 2],
            ['name' => 'Pitch Marking', 'main_process_id' => 2],
            ['name' => 'Center Hole', 'main_process_id' => 2],
            ['name' => 'Drill', 'main_process_id' => 2],
        ];
        foreach ($process as $key => $value) {
            Process::create($value);
        }
    }
}
