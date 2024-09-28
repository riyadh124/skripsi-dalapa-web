<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Workorder>
 */
class WorkorderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => 1,
            'nomor_tiket' => 'TCKT-' . uniqid(),
            'witel' => ['Witel Jakarta', 'Witel Balikpapan'][random_int(0, 1)],
            'sto' => $this->faker->address(),
            'headline' => $this->faker->sentence(mt_rand(5,10)),
            'lat' => -6.2088,
            'lng' => 106.8456,
            "evidence_before" => "path/to/evidence_before.jpg",
            "evidence_after" => "path/to/evidence_after.jpg",
            "status" => "Waiting"
            // 'foto_sebelum_pekerjaan' => json_encode(['image1.jpg', 'image2.jpg']),
            // 'list_material' => json_encode([
            //     ['nama' => 'material 1', 'harga' => 50000, 'total' => 5],
            //     ['nama' => 'material 2', 'harga' => 150000, 'total' => 3],
            // ]),'foto_setelah_pekerjaan' => json_encode(['image3.jpg', 'image4.jpg']),
            // 'foto_sebelum_pekerjaan' => json_encode(['image1.jpg', 'image2.jpg']),
            // 'list_material' => json_encode(['material1', 'material2']),
            // 'foto_setelah_pekerjaan' => json_encode(['image3.jpg', 'image4.jpg']),
        ];
    }
}
