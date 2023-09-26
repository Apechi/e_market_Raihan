<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\PurchaseDetail;
use Illuminate\Database\Eloquent\Factories\Factory;

class PurchaseDetailFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PurchaseDetail::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'harga_beli' => $this->faker->randomNumber(2),
            'jumlah' => $this->faker->randomNumber(0),
            'sub_total' => $this->faker->randomNumber(2),
            'purchase_id' => \App\Models\Purchase::factory(),
            'item_id' => \App\Models\Item::factory(),
        ];
    }
}
