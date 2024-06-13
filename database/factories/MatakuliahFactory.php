<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use \App\Models\Jurusan;
use \App\Models\Dosen;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Matakuliah>
 */
class MatakuliahFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $daftar_matakuliah = [
            "Matematika", "Blockchain", "Web Dasar", "Pengembangan Data", "Web Lanjut", "Kriptografi", "Pemrograman Dasar", "Pemrograman Mobile", "Algoritma Pemrograman", "Struktur Data", "Jaringan Komputer", "Manajemen Sistem Jaringan", "Statistika", "Aljabar dan Linear", "Machine Learning", "Pengembangan Aplikasi",
        ];
        $jurusan_id = $this->faker->numberBetween(1, Jurusan::count());
        $array_dosen = Dosen::where('jurusan_id', $jurusan_id)->get('id');

        return [
            'kode' => strtoupper($this->faker->unique()->bothify('??##')),
            'nama' => $this->faker->randomElement($daftar_matakuliah),
            'jumlah_sks' => $this->faker->numberBetween(1,4),
            'jurusan_id' => $jurusan_id,
            'dosen_id' => $this->faker->randomElement($array_dosen),
        ];
    }
}
