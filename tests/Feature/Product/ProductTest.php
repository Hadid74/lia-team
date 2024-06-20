<?php

namespace Tests\Feature\Product;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_product_validation(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $response = $this->postJson('api/dashboard/product',[
            'price'=>15,
            'inventory'=>1
        ]);

        $response->assertStatus(422)
        ->assertJsonValidationErrorFor('name');

        $response = $this->postJson('api/dashboard/product',[
            'name'=>'hadid',
            'inventory'=>1
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrorFor('price');

        $response = $this->postJson('api/dashboard/product',[
            'name'=>'iphone',
            'price'=>15,
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrorFor('inventory');

        $response = $this->postJson('api/dashboard/product',[
            'name'=>'iphone',
            'price'=>15,
            'inventory'=>-1 //negative quantity
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrorFor('inventory');
    }

    public function test_create_product()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $response = $this->postJson('api/dashboard/product',[
            'name'=>'iphone',
            'price'=>15,
            'inventory'=>1
        ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('products',['name'=>'iphone']);
    }

    public function test_update_product()
    {
        $user = User::factory()->create();
        $product=Product::create([
            'name'=>'iphone',
            'price'=>15,
            'inventory'=>1
        ]);
        $response=$this->actingAs($user)->putJson('api/dashboard/product/'.$product->id,[
            'name'=>'iphone',
            'price'=>19,
            'inventory'=>1
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('products',[
            '_id'=>$product->id,
            'name'=>'iphone',
            'price'=>19,
            'inventory'=>1
        ]);

    }

    public function test_delete_product()
    {
        $user = User::factory()->create();
        $product=Product::create([
            'name'=>'iphone',
            'price'=>15,
            'inventory'=>1
        ]);
        $response=$this->actingAs($user)->deleteJson('api/dashboard/product/'.$product->id);
        $response->assertStatus(200);
        $this->assertDatabaseMissing('products', ['_id' => $product->id, 'deleted_at' => null]);
        $this->assertSoftDeleted('products', ['_id' => $product->id]);
        $this->assertNotNull(Product::withTrashed()->find($product->id));



    }
}
