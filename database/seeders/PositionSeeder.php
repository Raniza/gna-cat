<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin\Position;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $position = [
            [
                'name' => 'Director', // 1
            ],
            [
                'name' => 'General Manager', // 2
            ],
            [
                'name' => 'Manager', // 3
            ],
            [
                'name' => 'Supervisor', // 4
            ],
            [
                'name' => 'Staff', // 5
            ],
            [
                'name' => 'General Foreman', // 6
            ],
            [
                'name' => 'Foreman', // 7
            ],
        ];

        foreach($position as $key => $value) {
            Position::create($value);
        }
    }
}
