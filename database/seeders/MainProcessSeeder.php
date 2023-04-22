<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin\MainProcess;

class MainProcessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $main = [
            ['name' => 'Forging'],
            ['name' => 'Machining'],
            ['name' => 'Heat Treatment'],
            ['name' => 'Plating'],
            ['name' => 'Assy'],
        ];

        foreach ($main as $key => $value) {
            MainProcess::create($value);
        }
    }
}
