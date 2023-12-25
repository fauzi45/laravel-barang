<?php

namespace Database\Factories;

use App\Models\Item;
use App\Models\Request;
use App\Models\RequestItem;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RequestItem>
 */
class RequestItemFactory extends Factory
{
    protected $model = RequestItem::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'request_id' => Request::class,
            'item_id' => Item::inRandomOrder()->first()->id,
            'quantity' => $this->faker->randomNumber(2),

        ];
    }
}
