<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Item;

use App\Models\Product;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ItemControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(
            User::factory()->create(['email' => 'admin@admin.com'])
        );

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_displays_index_view_with_items(): void
    {
        $items = Item::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('items.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.items.index')
            ->assertViewHas('items');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_item(): void
    {
        $response = $this->get(route('items.create'));

        $response->assertOk()->assertViewIs('app.items.create');
    }

    /**
     * @test
     */
    public function it_stores_the_item(): void
    {
        $data = Item::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('items.store'), $data);

        $this->assertDatabaseHas('items', $data);

        $item = Item::latest('id')->first();

        $response->assertRedirect(route('items.edit', $item));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_item(): void
    {
        $item = Item::factory()->create();

        $response = $this->get(route('items.show', $item));

        $response
            ->assertOk()
            ->assertViewIs('app.items.show')
            ->assertViewHas('item');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_item(): void
    {
        $item = Item::factory()->create();

        $response = $this->get(route('items.edit', $item));

        $response
            ->assertOk()
            ->assertViewIs('app.items.edit')
            ->assertViewHas('item');
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

        $response = $this->put(route('items.update', $item), $data);

        $data['id'] = $item->id;

        $this->assertDatabaseHas('items', $data);

        $response->assertRedirect(route('items.edit', $item));
    }

    /**
     * @test
     */
    public function it_deletes_the_item(): void
    {
        $item = Item::factory()->create();

        $response = $this->delete(route('items.destroy', $item));

        $response->assertRedirect(route('items.index'));

        $this->assertModelMissing($item);
    }
}
