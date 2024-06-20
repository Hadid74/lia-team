<?php

namespace Tests\Feature\User;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_create_admin_with_not_found_user(): void
    {
        $user = User::create([
            'name' => 'hadid',
            'email' => 'hadid@gmail.com',
            'password' => 'correct_password',
            'is_admin' => 1
        ]);
        $response = $this->actingAs($user)->putJson('api/dashboard/create-admin/not-exist-user');
        $response->assertStatus(400);
    }

    public function test_create_admin_with_correct_user(): void
    {
            $user1=User::create([
                'name' => 'hadid',
                'email' => 'hadid@gmail.com',
                'password' => 'correct_password',
                'is_admin' => 1
            ]);
            $user2=User::create([
                'name' => 'abbas',
                'email' => 'abbas@gmail.com',
                'password' => 'correct_password'
            ]);

        $response = $this->actingAs($user1)->putJson('api/dashboard/create-admin/' . $user2->id);
        $response->assertStatus(200);
        $user=User::find($user2->id);
        $this->assertEquals(1,(int)$user->is_admin);
    }
}
