<?php

namespace Tests\Feature\User;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Mockery\Mock;
use MongoDB\Laravel\Eloquent\Model;
use Tests\TestCase;

class OrderTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_with_no_inventory_product(): void
    {
//        $this->withoutExceptionHandling();
        $user = User::factory()->create();
        $prodcut=Product::create([
            'name'=>'iphone',
            'price'=>15,
            'inventory'=>1
        ]);
        $response = $this->actingAs($user)->post('/api/order',[
            'products'=>[
                [
                    "_id"=>$prodcut->id,
                    "name"=>$prodcut->name,
                    'price'=>$prodcut->price,
                    'inventory'=>2
                ]
            ],
            'total_price'=>15,
            'total_count'=>2
        ]);

        $response->assertStatus(302);
    }

    public function test_update_accordingly_product_inventory()
    {
        //        $this->withoutExceptionHandling();
        $user = User::factory()->create();
        $product=Product::create([
            'name'=>'iphone',
            'price'=>15,
            'inventory'=>10
        ]);
        $response = $this->actingAs($user)->post('/api/order',[
            'products'=>[
                [
                    "_id"=>$product->id,
                    "name"=>$product->name,
                    'price'=>$product->price,
                    'inventory'=>2
                ]
            ],
            'total_price'=>15,
            'total_count'=>2
        ]);
        $response->assertStatus(200);

        $this->assertDatabaseCount('orders',1);

        $this->assertDatabaseHas('products',[
            '_id'=>$product->id,
            'name'=>'iphone',
            'price'=>15,
            'inventory'=>8
        ]);
    }
}
