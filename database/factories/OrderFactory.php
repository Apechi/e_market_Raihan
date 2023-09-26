<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'no_faktur' => $this->faker->text(50),
            'tgl_faktur' => $this->faker->date(),
            'total_bayar' => $this->faker->randomNumber(2),
            'customer_id' => \App\Models\Customer::factory(),
            'user_id' => \App\Models\User::factory(),
        ];
    }
}
