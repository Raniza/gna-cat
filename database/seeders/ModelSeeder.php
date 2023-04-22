<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin\ModelPart;

class ModelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $model = [
            ['name' => '1WD'],
            ['name' => 'B74'],
            ['name' => 'BG6'],
            ['name' => '2MS'],
            ['name' => 'B6H'],
            ['name' => 'B5D'],
            ['name' => 'BEJ'],
            ['name' => 'B65'],
            ['name' => '2DP'],
            ['name' => '3C1'],
            ['name' => '2PV'],
            ['name' => 'BU3'],
            ['name' => 'B4T'],
            ['name' => 'BLS'],
            ['name' => 'BDJ'],
            ['name' => 'BK6'],
            
        ];

        foreach ($model as $key => $value) {
            ModelPart::create($value);
        }
    }
}
