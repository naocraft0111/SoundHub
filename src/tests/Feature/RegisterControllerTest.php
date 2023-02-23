<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterControllerTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_create()
    {
        $testUserName = 'テストユーザー';
        $testEmail = 'test@test.com';
        $testPassword = 'password123';
        $testPasswordConfirmation = 'password123';
        $testAge = '25';

        $response = $this->post(
            route('register'),
            [
                'name' => $testUserName,
                'email' => $testEmail,
                'password' => $testPassword,
                'password_confirmation' => $testPasswordConfirmation,
                'age' => $testAge
            ]
        );

        $this->assertDatabaseHas('users', [
            'name' => $testUserName,
            'email' => $testEmail,
            'age' => $testAge
        ]);

        $this->assertTrue(Hash::check(
            $testPassword,
            User::where('name', $testUserName)->first()->password
        ));

        $response->assertRedirect(route('articles.index'));
    }
}
