<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Admin\Position;
use App\Models\Admin\Department;
use App\Models\Admin\Section;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $date = $this->faker->dateTimeBetween('-30 days', now());
        $departmentId = $this->faker->numberBetween(1, 4);
        switch ($departmentId) {
            case 1:
                $sectionId = $this->faker->numberBetween(1, 2);
                break;
            case 2:
                $sectionId = $this->faker->numberBetween(3, 4);
                break;
            case 3:
                $sectionId = 5;
                break;
            case 4:
                $sectionId = $this->faker->numberBetween(6, 7);
                break;
        }

        return [
            'nik' => 'XN' . $this->faker->unique()->randomNumber(5, true),
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => bcrypt('12345678'),
            'isAdmin' => 0,
            'position_id' => $this->faker->numberBetween(4, 7),
            'department_id' => $departmentId,
            'section_id' => $sectionId,
            'created_at' => $date
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return $this
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
