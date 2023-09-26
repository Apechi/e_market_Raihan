<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Item;
use App\Models\OrderDetail;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ItemOrderDetailsTest extends TestCase
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
    public function it_gets_item_order_details(): void
    {
        $item = Item::factory()->create();
        $orderDetails = OrderDetail::factory()
            ->count(2)
            ->create([
                'item_id' => $item->id,
            ]);

        $response = $this->getJson(
            route('api.items.order-details.index', $item)
        );

        $response->assertOk()->assertSee($orderDetails[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_item_order_details(): void
    {
        $item = Item::factory()->create();
        $data = OrderDetail::factory()
            ->make([
                'item_id' => $item->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.items.order-details.store', $item),
            $data
        );

        unset($data['order_id']);
        unset($data['item_id']);
        unset($data['harga_jual']);
        unset($data['jumlah']);
        unset($data['sub_total']);

        $this->assertDatabaseHas('order_details', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $orderDetail = OrderDetail::latest('id')->first();

        $this->assertEquals($item->id, $orderDetail->item_id);
    }
}
