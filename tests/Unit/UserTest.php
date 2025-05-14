<?php

namespace Tests\Unit;

use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase; // Очищает БД перед каждым тестом

    #[Test]
    public function test_user_creation()
    {
        $response = $this->postJson('/api/registration', [
            'email' => 'test@example.com',
            'password' => 'password',
            'gender' => 'male',
        ]);

        $response->assertStatus(201)
            ->assertJsonStructure([
                'message',
                'user' => ['id', 'email', 'gender', 'created_at']
            ]);
    }

    #[Test]
    public function test_get_user()
    {
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
            'gender' => 'male',
        ]);

        $response = $this->getJson("/api/profile?email={$user->email}");

        $response->assertStatus(200)
            ->assertJson([
                'email' => $user->email,
                'gender' => $user->gender
            ]);
    }
}
