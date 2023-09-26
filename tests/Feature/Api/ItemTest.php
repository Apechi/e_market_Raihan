<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Item;

use App\Models\Product;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ItemTest extends TestCase
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
    public function it_gets_items_list(): void
    {
        $items = Item::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.items.index'));

        $response->assertOk()->assertSee($items[0]->kode_barang);
    }

    /**
     * @test
     */
    public function it_stores_the_item(): void
    {
        $data = Item::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.items.store'), $data);

        $this->assertDatabaseHas('items', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_item(): void
    {
        $item = Item::factory()->create();

        $user = User::factory()->create();
        $product = Product::factory()->create();

        $data = [
            'kode_barang' => $this->faker->text(50),
            'nama_barang' => $this->faker->text(255),
            'satuan' => $this->faker->text(10),
            'harga_jual' => $this->faker->randomNumber(2),
            'stok' => $this->faker->text(5),
            'ditarik' => $this->faker->randomNumber(0),
            'user_id' => $user->id,
            'product_id' => $product->id,
        ];

        $response = $this->putJson(route('api.items.update', $item), $data);

        $data['id'] = $item->id;

        $this->assertDatabaseHas('items', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_item(): void
    {
        $item = Item::factory()->create();

        $response = $this->deleteJson(route('api.items.destroy', $item));

        $this->assertModelMissing($item);

        $response->assertNoContent();
    }
}
