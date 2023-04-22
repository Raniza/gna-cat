<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
                'nik' => 'XN00797',
                'name' => 'Arlenda Fitranto',
                'email' => 'arlenda_ypmi@yamaha-motor.co.id',
                'password' => bcrypt('12345678'),
                'position_id' => 4,
                'department_id' => 4,
                'section_id' => 7,
                'isAdmin' => 1,
            ],
            [
                'nik' => 'XN08074',
                'name' => 'Bambang Eka Prawira',
                'email' => 'bambangep_pe2_YPMI@yamaha-motor.co.id',
                'password' => bcrypt('12345678'),
                'position_id' => 5,
                'department_id' => 2,
                'section_id' => 3,
            ],
        ];

        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}
