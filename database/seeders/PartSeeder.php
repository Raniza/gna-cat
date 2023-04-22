<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin\Part;

class PartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $parts = [
            ['name' => "AM"],
            ['name' => "AD"],
            ['name' => "G1W"],
            ['name' => "G2W"],
            ['name' => "G3W"],
            ['name' => "G4W"],
            ['name' => "G5W"],
            ['name' => "G6W"],
            ['name' => "G2P"],
            ['name' => "G3P"],
            ['name' => "G4P"],
            ['name' => "G5P"],
            ['name' => "G6P"],
            ['name' => "GPD"],
            ['name' => "GPDN"],
            ['name' => "Piston"],
            ['name' => "Crankshaft"],
            ['name' => "Crank 1"],
            ['name' => "Crank 2"],
            ['name' => "Weight"],
            ['name' => "Fork Shift"],
            ['name' => "Cam Shift"],
            ['name' => "Cam Sahft"],
            ['name' => "Pin Crank"],
            ['name' => "Pin Piston"],
            ['name' => "GBW"],
            ['name' => "GD"],
            ['name' => "Sprocket Drive"],
        ];
        foreach ($parts as $key => $value) {
            Part::create($value);
        }
    }
}
