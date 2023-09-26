<?php

namespace Database\Factories;

use App\Models\Ordershell;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrdershellFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Ordershell::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'total' => $this->faker->randomNumber(2),
            'terima' => $this->faker->randomNumber(2),
            'kembali' => $this->faker->randomNumber(2),
            'order_id' => \App\Models\Order::factory(),
        ];
    }
}
