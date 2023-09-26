<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Purchase;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserPurchasesTest extends TestCase
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
    public function it_gets_user_purchases(): void
    {
        $user = User::factory()->create();
        $purchases = Purchase::factory()
            ->count(2)
            ->create([
                'user_id' => $user->id,
            ]);

        $response = $this->getJson(route('api.users.purchases.index', $user));

        $response->assertOk()->assertSee($purchases[0]->kode_masuk);
    }

    /**
     * @test
     */
    public function it_stores_the_user_purchases(): void
    {
        $user = User::factory()->create();
        $data = Purchase::factory()
            ->make([
                'user_id' => $user->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.users.purchases.store', $user),
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

        $this->assertEquals($user->id, $purchase->user_id);
    }
}
