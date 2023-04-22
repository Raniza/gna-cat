<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin\Department;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $department = [
            [
                'name' => 'G&A #1 Production Engineering' // 1
            ],
            [
                'name' => 'G&A #2 Production Engineering' // 2
            ],
            [
                'name' => 'G&A #3 Production Engineering' // 3
            ],
            [
                'name' => 'Production Engineering System & Development' // 4
            ],
        ];

        foreach($department as $key => $value) {
            Department::create($value);
        }
    }
}
