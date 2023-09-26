<?php

namespace Database\Factories;

use App\Models\Rombel;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class RombelFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Rombel::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama_rombel' => $this->faker->text(255),
        ];
    }
}
