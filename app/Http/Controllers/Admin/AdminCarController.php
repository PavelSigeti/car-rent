<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CarStoreRequest;
use App\Models\Car;
use App\Models\Image;
use App\Models\Order;
use App\Repositories\CarPriceRepository;
use App\Repositories\CarRepository;
use App\Repositories\ImageRepository;
use App\Repositories\MetaRepository;
use App\Repositories\PlaceRepository;
use App\Services\Interfaces\ImagesContract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminCarController extends Controller
{
    private $adminCarRepository;
    private $carPriceRepository;
    private $metaRepository;
    private $imageRepository;
    private $placeRepository;

    private $imagesContract;

    public function __construct()
    {
        $this->adminCarRepository = app(CarRepository::class);
        $this->carPriceRepository = app(CarPriceRepository::class);
        $this->metaRepository = app(MetaRepository::class);
        $this->imageRepository = app(ImageRepository::class);
        $this->placeRepository = app(PlaceRepository::class);

        $this->imagesContract = app( ImagesContract::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cars = Car::all()->sortDesc();

        $images = $this->imageRepository->getAllMainImages();


        return view('admin.car.index', compact('cars', 'images'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $metas = $this->metaRepository->getAll();
        $places = $this->placeRepository->getAllLinks();

        return view('admin.car.create', compact('metas', 'places'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CarStoreRequest $request)
    {
        $slug = Str::slug($request->name);

        if(Car::query()->where('slug', '=', $slug)->exists()) {
            $carId = Car::query()->latest()->first()->id + 1;
            $slug .= '-'.$carId;
        }
        $car = Car::query()->create([
            'name' => $request->name,
            'price' => $request->price,
            'price2' => $request->price2,
            'price3' => $request->price3,
            'is_published' => $request->is_published,
            'seo_title' => $request->seo_title,
            'seo_description' => $request->seo_description,
            'seo_text' => $request->seo_text,
            'slug' => $slug,
            'engine' => $request->engine,
            'seats' => $request->seats,
            'year' => $request->year,
            'msg' => $request->msg,
            'zalog' => $request->zalog,
            'home_place' => $request->home_place,
            'discount' => $request->discount,
        ]);

        $car->metas()->sync($request->meta);

        return redirect()->route('car.edit', [$car->id]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $car = $this->adminCarRepository->getById($id);
        if($car == null) {
            abort(404);
        }

        $carPrices = $this->carPriceRepository->getCarPricesById($id);

        $metas = $this->metaRepository->getAll();
        $carMeta = $car->metas->keyBy('type');

        $places = $this->placeRepository->getAllLinks();

        $images = $this->imageRepository->getImageByCarId($id);
        $mainImage = $this->imageRepository->getMainImageByCarId($id);

        return view('admin.car.edit', compact('metas', 'carMeta',
            'car', 'images', 'mainImage', 'carPrices', 'places'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CarStoreRequest $request, $id)
    {

        $car = $this->adminCarRepository->getById($id);

        $car->update([
            'name' => $request->name,
            'price' => $request->price,
            'price2' => $request->price2,
            'price3' => $request->price3,
            'is_published' => $request->is_published,
            'seo_title' => $request->seo_title,
            'seo_description' => $request->seo_description,
            'seo_text' => $request->seo_text,
            'engine' => $request->engine,
            'seats' => $request->seats,
            'year' => $request->year,
            'msg' => $request->msg,
            'zalog' => $request->zalog,
            'home_place' => $request->home_place,
            'discount' => $request->discount,
        ]);

        $car->metas()->sync($request->meta);

        return redirect()->route('car.edit', [$id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $car = $this->adminCarRepository->getById($id);
        $car->delete();

        $this->imagesContract->deleteCarImages($id);

        return redirect()->route('car.index');
    }
}
