<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;
use App\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testUserCanGoToLogInForm()
    {
        $response = $this->get('/login');
        $response->assertSuccessful();
        $response->assertViewIs('auth.login');
    }

    public function testUserCanGoToRegisterForm()
    {
        $response = $this->get('/register');
        $response->assertSuccessful();
        $response->assertViewIs('auth.register');
    }


    public function testUserRedirectFromLogInWhenAuthenticated()
    {
        $user = factory(User::class)->make();
        $response = $this->actingAs($user)->get('/login');
        $response->assertRedirect('/');
    }

    public function testLogInUser()
    {
        $user = factory(User::class)->create([
            'password' => bcrypt($password = 'secretPassword'),
        ]);

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => $password,
        ]);

        $response->assertRedirect('/');
        $this->assertAuthenticatedAs($user);
    }

    public function testInvalidLogInUser()
    {
        $user = factory(User::class)->create([
            'password' => bcrypt($password = 'secretPassword'),
        ]);

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'invalidPAssword',
        ]);


        $response->assertSessionHasErrors('email');
        $this->assertTrue(session()->hasOldInput('email'));
        $this->assertFalse(session()->hasOldInput('password'));
        $this->assertGuest();
    }
}
