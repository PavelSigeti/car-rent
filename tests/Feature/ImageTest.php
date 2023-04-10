<?php

namespace Tests\Feature;

use App\Models\Car;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class ImageTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_saveMainImage()
    {
        $this->seed();
        $user = User::query()->where('role', 1)->first();

        $car = Car::query()->first();

        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->post('/dashboard/image-main-save/'.$car->id, [
                'main_img' => UploadedFile::fake()->image('photo2.jpg'),
            ]);

        $response->assertRedirectContains('/dashboard/car/'.$car->id.'/edit');
    }
}
