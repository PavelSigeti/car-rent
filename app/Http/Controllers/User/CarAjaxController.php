<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\PlaceAjaxRequest;
use App\Repositories\PlaceRepository;
use Illuminate\Http\Request;

class CarAjaxController extends Controller
{
    private $placeRepository;

    public function __construct()
    {
        $this->placeRepository = app(PlaceRepository::class);
    }

    public function place()
    {
        $place = $this->placeRepository->getPlaceData();


        return response()->json(['result'=>$place]);
    }
}
