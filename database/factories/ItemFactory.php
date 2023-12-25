<?php

namespace Database\Factories;

use App\Models\Item;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Item>
 */
class ItemFactory extends Factory
{
    protected $model = Item::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama_barang' => $this->faker->word,
            'lokasi_barang' => $this->faker->word,
            'jumlah_stok' => $this->faker->randomNumber(2),
            'satuan' => $this->faker->randomElement(['pcs', 'kg', 'box']),
        ];
    }
}
