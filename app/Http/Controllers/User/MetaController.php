<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Meta;
use App\Repositories\CarRepository;
use App\Repositories\ImageRepository;
use App\Repositories\MetaRepository;
use App\Repositories\PlaceRepository;
use App\Repositories\SettingRepository;

class MetaController extends Controller
{
    private $carRepository;
    private $metaRepository;
    private $imageRepository;
    private $settingRepository;
    private $placeRepository;

    public function __construct()
    {
        $this->carRepository = app(CarRepository::class);
        $this->metaRepository = app(MetaRepository::class);
        $this->imageRepository = app(ImageRepository::class);
        $this->settingRepository = app(SettingRepository::class);
        $this->placeRepository = app(PlaceRepository::class);
    }

    public function meta($type, $slug)
    {
        if(!Meta::query()->where('slug',$slug)->exists() || !Meta::query()->where('type',$type)->exists()) {
            return abort(404);
        }
        $meta = $this->metaRepository->getBySlug($slug);
        $cars = $this->carRepository->getByType($type, $slug);
        $images = $this->imageRepository->getThumbById($cars->keys());
        $settings = $this->settingRepository->getAllForUser();
        $places = $this->placeRepository->getAllLinks();

        return view('user.type.index', compact('meta', 'cars','images','settings', 'places', 'type', 'slug'));
    }
}
