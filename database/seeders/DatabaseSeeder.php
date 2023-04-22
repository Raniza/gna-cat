<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call([
            ModelSeeder::class,
            PartSeeder::class,
            MainProcessSeeder::class,
            MasterProcessSeeder::class,
            DepartmentSeeder::class,
            SectionSeeder::class,
            PositionSeeder::class,
            UserSeeder::class,
            MasterToolSeeder::class,
        ]);
        \App\Models\User::factory(100)->create();
    }
}
