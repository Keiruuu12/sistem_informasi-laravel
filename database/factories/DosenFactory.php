<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use \App\Models\Jurusan;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Dosen>
 */
class DosenFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $daftar_title = ["M.Kom", "M.Sc", "M.T", "M.Si"];
        return [
            'nid' => $this->faker->unique()->numerify('99######'),
            'nama' => $this->faker->firstName()." ".$this->faker->lastName()." ".$this->faker->randomElement($daftar_title),
            'jurusan_id' => $this->faker->numberBetween(1, Jurusan::count()),
        ];
    }
}
