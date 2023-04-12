<?php

namespace Tests\Feature;

use App\Models\Car;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
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
                'main_img' => UploadedFile::fake()->image('photo.jpg', 1000, 1000),
            ]);

        $response->assertRedirectContains('/dashboard/car/'.$car->id.'/edit');
    }

    public function test_saveImages()
    {
        $this->seed();
        $user = User::query()->where('role', 1)->first();

        $car = Car::query()->first();

        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->post('/dashboard/image-save/'.$car->id, [
                'images' => [
                    UploadedFile::fake()->image('photo.jpg', 1000, 1000),
                    UploadedFile::fake()->image('photo.jpg', 800, 800)
                ],
            ]);

        $response->assertRedirectContains('/dashboard/car/'.$car->id.'/edit');
    }

    public function test_savePlaceImage()
    {
        $this->seed();
        $user = User::query()->where('role', 1)->first();

        $car = Car::query()->first();

        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->post('/dashboard/image-place/'.$car->id, [
                'main_img' => UploadedFile::fake()->image('photo.jpg', 1000, 1000),
            ]);

        $response->assertRedirectContains('/dashboard/place/'.$car->id.'/edit');
    }

    public function test_savePostImage()
    {
        $this->seed();
        $user = User::query()->where('role', 1)->first();

        $car = Car::query()->first();

        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->post('/dashboard/image-post/'.$car->id, [
                'main_img' => UploadedFile::fake()->image('photo.jpg', 1000, 1000),
            ]);

        $response->assertRedirectContains('/dashboard/post/'.$car->id.'/edit');
    }

    public function test_imageDelete()
    {
        $this->seed();
        $user = User::query()->where('role', 1)->first();

        $car = Car::query()->first();

        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->delete('/dashboard/image-delete/'.$car->id.'/0', [
                'main_img' => UploadedFile::fake()->image('photo.jpg', 1000, 1000),
            ]);

        $response->assertRedirectContains('/dashboard/car/'.$car->id.'/edit');
    }
}
