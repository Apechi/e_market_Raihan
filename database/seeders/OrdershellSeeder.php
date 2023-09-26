<?php

namespace Database\Seeders;

use App\Models\Ordershell;
use Illuminate\Database\Seeder;

class OrdershellSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Ordershell::factory()
            ->count(5)
            ->create();
    }
}
