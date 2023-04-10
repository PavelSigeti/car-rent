<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PlaceStoreRequest;
use App\Http\Requests\PlaceUpdateRequest;
use App\Models\Place;
use App\Repositories\ImageRepository;
use App\Repositories\PlaceRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PlaceController extends Controller
{
    private $placeRepository;
    private $imageRepository;

    public function __construct()
    {
        $this->placeRepository = app(PlaceRepository::class);
        $this->imageRepository = app(ImageRepository::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $places = $this->placeRepository->getAll();

        return view('admin.place.index', compact('places'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.place.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PlaceStoreRequest $request)
    {
        $slug = Str::slug($request->slug);

        if(Place::query()->where('slug', '=', $slug)->exists()) {
            $placeId = Place::query()->latest()->first()->id + 1;
            $slug .= '-'.$placeId;
        }
        $place = Place::query()->create([
            'name' => $request->name,
            'title' => $request->title,
            'delivery_price' => $request->delivery_price,
            'extra_price' => $request->extra_price,
            'small_text' => $request->small_text,
            'big_text' => $request->big_text,
            'seo_title' => $request->seo_title,
            'seo_description' => $request->seo_description,
            'slug' => $slug,
        ]);

        return redirect()->route('place.edit', [$place->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $place = $this->placeRepository->getById($id);
        $image = $this->imageRepository->getPlaceImage($id);


        return view('admin.place.edit', compact('place', 'image'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PlaceUpdateRequest $request, $id)
    {

        $place = $this->placeRepository->getById($id);

        $slug = Str::slug($request->slug);

        if(Place::query()->where('slug', '=', $slug)->where('id', '!=', $id)->exists()) {
            $placeId = Place::query()->latest()->first()->id + 1;
            $slug .= '-'.$placeId;
        }
        $place->update([
            'name' => $request->name,
            'title' => $request->title,
            'delivery_price' => $request->delivery_price,
            'extra_price' => $request->extra_price,
            'small_text' => $request->small_text,
            'big_text' => $request->big_text,
            'seo_title' => $request->seo_title,
            'seo_description' => $request->seo_description,
            'slug' => $slug,
            'min_days' => $request->min_days,
            'min_days_price' => $request->min_days_price,
        ]);

        return redirect()->route('place.edit', [$place->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $place = Place::query()->find($id);
        $place->delete();

        return redirect()->route('place.index');
    }
}
