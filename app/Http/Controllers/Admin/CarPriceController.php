<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CarPriceStoreRequest;
use App\Http\Requests\CarPriceUpdateRequest;
use App\Models\CarPrice;
use App\Repositories\CarPriceRepository;

class CarPriceController extends Controller
{
    private $carPriceRepository;

    public function __construct()
    {
        $this->carPriceRepository = app(CarPriceRepository::class);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CarPriceStoreRequest $request, $id)
    {
        CarPrice::query()->create([
            'car_id' => $id,
            'price' => $request->price,
            'price2' => $request->price2,
            'price3' => $request->price3,
            'start' => $request->start,
            'end' => $request->end,
        ]);

        return redirect()->route('car.edit', [$id]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CarPriceUpdateRequest $request, $id)
    {
        $carPrice = $this->carPriceRepository
            ->getCarPriceForUpdate($id);

        $carPrice->update([
            'price' => $request->price,
            'price2' => $request->price2,
            'price3' => $request->price3,
        ]);

        return;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $carPrice = $this->carPriceRepository
            ->getCarPriceForUpdate($id);

        $carId= $carPrice->car_id;
        $carPrice->delete();

        return  redirect()->route('car.edit', [$carId]);
    }
}
