<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Item;
use App\Models\PurchaseDetail;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ItemPurchaseDetailsTest extends TestCase
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
    public function it_gets_item_purchase_details(): void
    {
        $item = Item::factory()->create();
        $purchaseDetails = PurchaseDetail::factory()
            ->count(2)
            ->create([
                'item_id' => $item->id,
            ]);

        $response = $this->getJson(
            route('api.items.purchase-details.index', $item)
        );

        $response->assertOk()->assertSee($purchaseDetails[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_item_purchase_details(): void
    {
        $item = Item::factory()->create();
        $data = PurchaseDetail::factory()
            ->make([
                'item_id' => $item->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.items.purchase-details.store', $item),
            $data
        );

        unset($data['purchase_id']);
        unset($data['item_id']);
        unset($data['harga_beli']);
        unset($data['jumlah']);
        unset($data['sub_total']);

        $this->assertDatabaseHas('purchase_details', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $purchaseDetail = PurchaseDetail::latest('id')->first();

        $this->assertEquals($item->id, $purchaseDetail->item_id);
    }
}
