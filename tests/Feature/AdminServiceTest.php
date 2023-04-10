<?php

namespace Tests\Feature;

use App\Models\Service;
use App\Models\User;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdminServiceTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_service_index()
    {
        $this->seed(UserSeeder::class);

        $user = User::query()->where('role', 1)->first();

        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->get('/dashboard/service');

        $response->assertStatus(200);
    }

    public function test_service_store()
    {
        $this->seed();
        $user = User::query()->where('role', 1)->first();

        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->post('/dashboard/service/store', [
                'name' => 'Test service',
                'price' => 0,
            ]);

        $response->assertRedirectContains('/dashboard/service');
    }

    public function test_service_delete()
    {
        $this->seed();
        $user = User::query()->where('role', 1)->first();

        $service = Service::query()->first();
        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->delete('/dashboard/service/'.$service->id.'/delete');

        $response->assertRedirectContains('/dashboard/service');
    }
}
