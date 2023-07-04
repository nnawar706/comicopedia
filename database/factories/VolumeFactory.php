<?php

namespace Database\Factories;

use App\Models\Volume;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Volume>
 */
class VolumeFactory extends Factory
{

    protected $model = Volume::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'item_id' => 1,
            'catalogue_id' => 1,
            'product_unique_id' => 'VOL-' . date('Hsi') . '-' . rand(10000,99999),
            'title' => $this->faker->name(),
            'isbn' => $this->faker->isbn10(),
            'details' => $this->faker->sentence(200),
            'release_date' => date('Y-m-d'),
            'image_path' => '/uploads/volumes/1687433043989.jpg',
            'quantity' => $this->faker->randomNumber(2),
            'price' => $this->faker->randomNumber(4),
            'cost' => 1245,
            'view_count' => $this->faker->randomNumber(2),
        ];
    }
}
