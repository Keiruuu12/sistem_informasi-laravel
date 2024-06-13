<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Jurusan>
 */
class JurusanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $daftar_jurusan = ["Sistem Informasi", "Teknik Informasi", "Data Science"];

        return [
            'nama' => $this->faker->unique()->randomElement($daftar_jurusan),
            'kepala_jurusan' => "Dr. ".$this->faker->firstName()." ".
                                $this->faker->lastName(),
            'daya_tampung' => $this->faker->numberBetween(5,8)*10,
        ];
    }
}
