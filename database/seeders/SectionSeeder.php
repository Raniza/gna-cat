<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin\Section;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $section = [
            [
                'name' => 'Forging & H/T Prod. Eng.', // 1
                'department_id' => 1,
            ],
            [
                'name' => 'Machining Prod. Eng.', // 2
                'department_id' => 1,
            ],
            [
                'name' => 'Crank Shaft Prod. Eng.', // 3
                'department_id' => 2,
            ],
            [
                'name' => 'Piston Prod. Eng.', // 4
                'department_id' => 2,
            ],
            [
                'name' => 'Shaft & Gear Prod. Eng.', // 5
                'department_id' => 3,
            ],
            [
                'name' => 'Engineering System', // 6
                'department_id' => 4,
            ],
            [
                'name' => 'New Model Preparation', // 7
                'department_id' => 4,
            ],
        ];

        foreach($section as $key => $value) {
            Section::create($value);
        }
    }
}
