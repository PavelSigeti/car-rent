<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Repositories\CarRepository;
use App\Repositories\ImageRepository;
use App\Repositories\PlaceRepository;
use App\Repositories\SettingRepository;
use Illuminate\Http\Request;

class PlaceController extends Controller
{
    private $carRepository;
    private $imageRepository;
    private $settingRepository;
    private $placeRepository;

    public function __construct()
    {
        $this->placeRepository = app(PlaceRepository::class);
        $this->carRepository = app(CarRepository::class);
        $this->imageRepository = app(ImageRepository::class);
        $this->settingRepository = app(SettingRepository::class);

        $this->amount = 18;
    }

    public function show($slug)
    {
        $place = $this->placeRepository->getBySlug($slug);
        if($place == null) {
            abort(404);
        }

        $cars = $this->carRepository->getCars();
        $images = $this->imageRepository->getThumbById($cars->keys());
        $settings = $this->settingRepository->getAllForUser();
        $places = $this->placeRepository->getAllLinks();

        return view('user.place.index', compact('cars', 'images', 'settings',
            'place', 'places'));

    }
}
