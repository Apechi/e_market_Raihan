<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Supplier;
use App\Models\Purchase;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SupplierPurchasesTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create(['email' => 'admin@admin.com']);

        Sanctum::actingAs($user, [], 'web');

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_gets_supplier_purchases(): void
    {
        $supplier = Supplier::factory()->create();
        $purchases = Purchase::factory()
            ->count(2)
            ->create([
                'supplier_id' => $supplier->id,
            ]);

        $response = $this->getJson(
            route('api.suppliers.purchases.index', $supplier)
        );

        $response->assertOk()->assertSee($purchases[0]->kode_masuk);
    }

    /**
     * @test
     */
    public function it_stores_the_supplier_purchases(): void
    {
        $supplier = Supplier::factory()->create();
        $data = Purchase::factory()
            ->make([
                'supplier_id' => $supplier->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.suppliers.purchases.store', $supplier),
            $data
        );

        unset($data['kode_masuk']);
        unset($data['tanggal_masuk']);
        unset($data['total']);
        unset($data['supplier_id']);
        unset($data['user_id']);

        $this->assertDatabaseHas('purchases', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $purchase = Purchase::latest('id')->first();

        $this->assertEquals($supplier->id, $purchase->supplier_id);
    }
}
