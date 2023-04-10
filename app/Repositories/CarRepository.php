<?php

namespace App\Repositories;
use App\Models\Car as Model;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class CarRepository extends CoreRepository
{
    protected function getModelClass()
    {
        return Model::class;
    }

    public function getById($id)
    {
        return $this->startConditions()->find($id);
    }

    public function getCars()
    {
        $today = Carbon::now();
        $today->year = 2020;
        $today->hour = 0;
        $today->minute = 0;
        $today->second = 0;


        $columns = [
            'cars.id', 'cars.name', 'cars.price', 'cars.discount',
            'cars.seats', 'cars.slug', 'cars.home_place',
            DB::raw('(CASE WHEN car_prices.price IS NULL THEN cars.price
                ELSE car_prices.price
                END) AS car_price')

        ];

        $result = $this->startConditions()
//            ->leftJoin('car_prices', 'cars.id', '=', 'car_prices.car_id')
            ->leftJoin('car_prices', function ($join) use ($today) {
                $join->on('cars.id', '=', 'car_prices.car_id')
                    ->where('car_prices.start', '<=', $today->format('Y-m-d H:i:s'))
                    ->where('car_prices.end', '>=', $today->format('Y-m-d H:i:s'));
            })
            ->with('metas')
            ->select($columns)
            ->where('is_published', '=', 1)
            ->orderBy('car_price', 'ASC')
            ->get()
            ->keyBy('id');

        return $result;
    }

    public function getCarBySlug($slug)
    {
        $columns = ['cars.id', 'name', 'cars.price', 'cars.price2', 'cars.price3',
                'seats', 'slug', 'engine', 'year',
                'seo_title', 'seo_description', 'seo_text', 'msg',
                'zalog', 'home_place',
                DB::raw('(CASE WHEN car_prices.price IS NULL THEN cars.price ELSE (SELECT min(price) from car_prices where cars.id = car_prices.car_id) END) AS car_price')
            ];
        $result = $this->startConditions()
            ->leftJoin('car_prices', 'cars.id', '=', 'car_prices.car_id')
            ->select($columns)
            ->where('slug', '=', $slug)
            ->where('is_published', '=', 1)
            ->first();

        return $result;
    }

    public function getFromIdArray($array) {

        $columns = [
            'cars.id', 'cars.name', 'cars.price',
            'cars.seats', 'cars.slug',
            DB::raw('(CASE WHEN car_prices.price IS NULL THEN cars.price ELSE (SELECT min(price) from car_prices where cars.id = car_prices.car_id) END) AS car_price')
        ];

        $result = $this->startConditions()
            ->leftJoin('car_prices', 'cars.id', '=', 'car_prices.car_id')
            ->with('metas')
            ->select($columns)
            ->whereIn('cars.id',$array)
            ->orderBy('car_price', 'asc')
            ->get()
            ->keyBy('id');

        return $result;
    }

    public function getSame($car) {
        $price = $car->price;

        $result = $this->startConditions()
            ->select('price', 'id', DB::raw("ABS(price - $price) AS abs_price"))
            ->where('id', '!=', $car->id)
            ->where('is_published', '=', 1)
            ->orderBy('abs_price')
            ->limit(3)
            ->pluck('id')
            ->toArray();

        return $result;
    }

    public function getByType($type, $slug)
    {
        $columns = [
            'cars.id', 'cars.name', 'cars.price', 'cars.discount',
            'cars.seats', 'cars.slug', 'cars.home_place',
            DB::raw('(CASE WHEN car_prices.price IS NULL THEN cars.price ELSE (SELECT min(price) from car_prices where cars.id = car_prices.car_id) END) AS car_price')
        ];

        $result = $this->startConditions()
            ->leftJoin('car_prices', 'cars.id', '=', 'car_prices.car_id')
            ->whereHas('metas', function($q) use($type, $slug) {
                $q->where('type', '=', $type)
                    ->where('slug', '=', $slug);
             })
            ->with('metas')
            ->with('prices')
            ->select($columns)
            ->get()
            ->sortBy('car_price')
            ->keyBy('id');

        return $result;
    }

}
