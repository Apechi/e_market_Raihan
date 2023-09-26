<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Adding an admin user
        $user = \App\Models\User::factory()
            ->count(1)
            ->create([
                'email' => 'admin@admin.com',
                'password' => Hash::make('admin'),
            ]);
        $this->call(PermissionsSeeder::class);

        // $this->call(CustomerSeeder::class);
        // $this->call(ItemSeeder::class);
        // $this->call(OrderSeeder::class);
        // $this->call(OrderDetailSeeder::class);
        // $this->call(OrdershellSeeder::class);
        // $this->call(ProductSeeder::class);
        // $this->call(PurchaseSeeder::class);
        // $this->call(PurchaseDetailSeeder::class);
        // $this->call(RombelSeeder::class);
        // $this->call(SupplierSeeder::class);
        // $this->call(TransactionSeeder::class);
        // $this->call(TransactionDetailSeeder::class);
        // $this->call(TransactionTypeSeeder::class);
        $this->call(UserSeeder::class);
    }
}
