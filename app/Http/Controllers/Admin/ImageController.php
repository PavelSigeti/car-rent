<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ImageMainRequest;
use App\Http\Requests\ImagePlaceRequest;
use App\Http\Requests\ImageSaveRequest;
use App\Repositories\CarRepository;
use App\Services\Interfaces\ImagesContract;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    private $adminCarRepository;

    private $imagesContract;

    public function __construct()
    {
        $this->adminCarRepository = app(CarRepository::class);

        $this->imagesContract = app( ImagesContract::class);
    }

    public function saveImages(ImageSaveRequest $request, $carId)
    {
        if ($request->hasfile('images')) {
            $this->imagesContract->saveImages($request->file('images'), $carId);
        }
        return redirect()->route('car.edit', $carId);
    }

    public function saveMainImage(ImageMainRequest $request, $carId)
    {
        if ($request->hasfile('main_img')) {
            $this->imagesContract->saveMainImage($request->file('main_img'), $carId);
        }
        return redirect()->route('car.edit', $carId);
    }

    public function savePlaceImage(ImagePlaceRequest $request, $placeId)
    {
        if ($request->hasfile('main_img')) {
            $this->imagesContract->savePlaceImage($request->file('main_img'), $placeId);
        }
        return redirect()->route('place.edit', $placeId);
    }

    public function savePostImage(ImagePlaceRequest $request, $postId)
    {
        if ($request->hasfile('main_img')) {
            $this->imagesContract->savePostImage($request->file('main_img'), $postId);
        }
        return redirect()->route('post.edit', $postId);
    }

    public function destroy($carId, $groupId)
    {
        $this->imagesContract->deleteImage($carId, $groupId);
        return redirect()->route('car.edit', [$carId]);
    }

}
