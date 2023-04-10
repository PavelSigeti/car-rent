<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Repositories\CarPriceRepository;
use App\Repositories\CarRepository;
use App\Repositories\ImageRepository;
use App\Repositories\PlaceRepository;
use App\Repositories\PostRepository;
use App\Repositories\ServiceRepository;
use App\Repositories\SettingRepository;

class CarController extends Controller
{
    private $carRepository;
    private $carPriceRepository;
    private $imageRepository;
    private $placeRepository;
    private $serviceRepository;
    private $settingRepository;
    private $postRepository;

    public function __construct()
    {
        $this->carRepository = app(CarRepository::class);
        $this->carPriceRepository = app(CarPriceRepository::class);
        $this->imageRepository = app(ImageRepository::class);
        $this->placeRepository = app(PlaceRepository::class);
        $this->serviceRepository = app(ServiceRepository::class);
        $this->settingRepository = app(SettingRepository::class);
        $this->postRepository = app(PostRepository::class);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cars = $this->carRepository->getCars();
        $images = $this->imageRepository->getThumbById($cars->keys());
        $settings = $this->settingRepository->getAllForUser();

        $places = $this->placeRepository->getAllLinks();
        $placeImages = $this->imageRepository->getPlaceById(array_keys($places));

        $posts = $this->postRepository->getLatest();
        $postImages = $this->imageRepository->getPostById(array_keys($posts));

        return view('welcome', compact('cars', 'images', 'settings',
            'places', 'placeImages', 'posts', 'postImages'));
    }

    public function car()
    {
        $cars = $this->carRepository->getCars();
        $images = $this->imageRepository->getThumbById($cars->keys());
        $settings = $this->settingRepository->getAllForUser();

        $places = $this->placeRepository->getAllLinks();

        return view('park', compact('cars', 'images', 'settings', 'places'));
    }

    /**
     * Display the specified resource.
     *
//     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $car = $this->carRepository->getCarBySlug($slug);
        if($car == null) {
            abort(404);
        }
        $carPrices = $this->carPriceRepository->getCarPricesById($car->id);
        $carImages = $this->imageRepository->getByCarId($car->id);
        $places = $this->placeRepository->getAll();
        $services = $this->serviceRepository->getAll();
        $settings = $this->settingRepository->getAllForUser();
        $sameCarsId = $this->carRepository->getSame($car);
        $same = $this->carRepository->getFromIdArray($sameCarsId);
        $images = $this->imageRepository->getThumbById($sameCarsId);

        $placeData = $this->placeRepository->getPlaceData();

        $carDefaultPrice = array(
            'price' => $car->price,
            'price2' => $car->price2,
            'price3' => $car->price3,
        );
        $datePicker = date('d.m.Y').' - '.date('d.m.Y', time() + 2*24*3600);

        return view('user.car.show', compact('car', 'carImages', 'carPrices',
            'places', 'datePicker', 'services', 'settings', 'same', 'images', 'placeData',
            'carDefaultPrice'));
    }

}
