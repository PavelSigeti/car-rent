<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Repositories\CarRepository;
use App\Repositories\ImageRepository;
use App\Repositories\PageRepository;
use App\Repositories\PlaceRepository;
use App\Repositories\SettingRepository;
use Illuminate\Http\Request;

class PagePlaceController extends Controller
{
    private $carRepository;
    private $imageRepository;
    private $settingRepository;
    private $placeRepository;
    private $pageRepository;

    public function __construct()
    {
        $this->placeRepository = app(PlaceRepository::class);
        $this->carRepository = app(CarRepository::class);
        $this->imageRepository = app(ImageRepository::class);
        $this->settingRepository = app(SettingRepository::class);
        $this->pageRepository = app(PageRepository::class);

        $this->amount = 18;
    }

    public function show($slug)
    {
        $place = $this->placeRepository->getBySlug($slug);
        $page = $this->pageRepository->getBySlug($slug);

        if($place !== null) {
            $cars = $this->carRepository->getCars();
            $images = $this->imageRepository->getThumbById($cars->keys());
            $settings = $this->settingRepository->getAllForUser();
            $places = $this->placeRepository->getAllLinks();

            return view('user.place.index', compact('cars', 'images', 'settings',
                'place', 'places'));
        } elseif($page !== null) {
            $settings = $this->settingRepository->getAllForUser();
            $places = $this->placeRepository->getAllLinks();

            return view('user.page.show', compact('page', 'settings', 'places'));
        } else {
            abort(404);
        }

    }
}
