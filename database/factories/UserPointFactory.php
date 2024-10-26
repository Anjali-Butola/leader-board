<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserPoint>
 */
class UserPointFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => rand(1,10),
            'activity' => Str::random(5),
            'date' => date('Y-m-d', strtotime('+'.mt_rand(0,30).'days')),
            'time' => date('H:i:s'),
            'points'=> rand(1,20)
        ];
    }
}
