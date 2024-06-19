<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_register_user_validation(): void
    {


        $response = $this->postJson('api/user/register', [
            'name' => 'hadid',
            'password' => 'jfaa'
        ]);
        $response->assertStatus(422)
            ->assertJsonValidationErrorFor('email');

        $response = $this->postJson('api/user/register', [
            'email' => 'hadid@gmail.com',
            'password' => 'jfaa'
        ]);
        $response->assertStatus(422)
            ->assertJsonValidationErrorFor('name');

        $response = $this->postJson('api/user/register', [
            'name' => 'hadid',
            'email' => 'hadid@gmail.com'
        ]);
        $response->assertStatus(422)
            ->assertJsonValidationErrorFor('password');

        $response = $this->postJson('api/user/register', [
            'name' => 'hadid',
            'email' => 'hadid@gmail.com',
            'password' => '123'
        ]);
        $response->assertStatus(422)
            ->assertJsonValidationErrorFor('password')
            ->assertJson(['message' => 'The password field must be at least 4 characters.']);
    }

    public function test_register_user_with_duplicate_email()
    {
//        $this->withoutExceptionHandling();
        User::create([
            'name' => 'hadid',
            'email' => 'hadid@gmail.com',
            'password' => '1234',
            'is_admin' => true
        ]);
        $response = $this->postJson('api/user/register', [
            'name' => 'hadid',
            'email' => 'hadid@gmail.com',
            'password' => '1234'
        ]);

        $response->assertStatus(422)->assertJsonValidationErrorFor('email');
    }

    public function test_register_user()
    {
        $response = $this->postJson('api/user/register', [
            'name' => 'hadid',
            'email' => 'hadid@gmail.com',
            'password' => '1234'
        ]);
        $response->assertStatus(201);
        $this->assertDatabaseHas('users', [
            'email' => 'hadid@gmail.com',
            'is_admin' => null
        ]);
    }

    public function test_login_validation()
    {
        User::create([
            'name' => 'hadid',
            'email' => 'hadid@gmail.com',
            'password' => '1234'
        ]);
        $response = $this->postJson('api/user/login', [
            'email' => 'hadid@gmail.com',
            'password' => '123'
        ]);
        $response->assertStatus(422)
            ->assertJsonValidationErrorFor('password');

        $response = $this->postJson('api/user/login', [
            'email' => 'hadidd@gmail.com',
            'password' => '1234'
        ]);
        $response->assertStatus(422)
            ->assertJsonValidationErrorFor('email');
    }

    public function test_with_wrong_password()
    {
        User::create([
            'name' => 'hadid',
            'email' => 'hadid@gmail.com',
            'password' => '1234'
        ]);
        $response = $this->postJson('api/user/login', [
            'email' => 'hadid@gmail.com',
            'password' => 'wrong_password'
        ]);
        $response->assertStatus(401);
        $this->assertGuest();
    }

    public function test_with_correct_credential()
    {
        User::create([
            'name' => 'hadid',
            'email' => 'hadid@gmail.com',
            'password' => 'correct_password'
        ]);
        $response = $this->postJson('api/user/login', [
            'email' => 'hadid@gmail.com',
            'password' => 'correct_password'
        ]);

        $response->assertStatus(200);
        $this->assertAuthenticated();
    }

    public function test_logout_user()
    {
//        $this->withoutExceptionHandling();
        $user = User::create([
            'name' => 'hadid',
            'email' => 'hadid@gmail.com',
            'password' => 'correct_password'
        ]);

        $token=auth()->attempt(['email'=>$user->email,'password'=>'correct_password']);
        $response = $this->postJson('api/user/logout',[
            'Authorization' => 'Bearer ' . $token,
            ]);
        $response->assertStatus(200);
        $this->assertGuest();
    }
}
