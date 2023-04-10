<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdminTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_dashboard()
    {
        $user = User::factory([
            'role' => 1,
        ]);

        $response = $this->actingAs($user)
                        ->withSession(['banned' => false])
                        ->get('/dashboard');

        $response->assertStatus(200);
    }
}
