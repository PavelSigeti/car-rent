<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderStoreRequest;
use App\Mail\OrderCreateMail;
use App\Models\Order;
use App\Repositories\CarPriceRepository;
use App\Repositories\CarRepository;
use App\Repositories\PlaceRepository;
use App\Repositories\ServiceRepository;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    private $carRepository;
    private $carPriceRepository;
    private $placeRepository;
    private $serviceRepository;

    public function __construct()
    {
        $this->carRepository = app(CarRepository::class);
        $this->carPriceRepository = app(CarPriceRepository::class);
        $this->placeRepository = app(PlaceRepository::class);
        $this->serviceRepository = app(ServiceRepository::class);
    }

    public function store(OrderStoreRequest $request, $id)
    {

        $car = $this->carRepository->getById($id);
        $carPrices = $this->carPriceRepository->getCarPricesById($car->id);

        $dates = explode(' - ', $request->date);

        $startDate = Carbon::parse($dates[0]);
        $endDate = Carbon::parse($dates[1]);

        $dateDiff = $endDate->diffInDays($startDate);

        $startTime = \DateTime::createFromFormat('H:i', $request->start_time);
        $endTime = \DateTime::createFromFormat('H:i', $request->end_time);

        $timeDiff = (int)$endTime->format("H") - (int)$startTime->format("H");

        $startPlace = $this->placeRepository->getById($request->start_place);
        $endPlace = $this->placeRepository->getById($request->end_place);



        if($car->home_place !== null) {
            $deliveryPrice = 0;
            $deliveryPriceBack = 0;
            if($request->start_place !== $request->end_place) {
                $deliveryPriceBack = $startPlace->delivery_price;
            }
        } else {
            $deliveryPrice = $startPlace->delivery_price;
            $deliveryPriceBack = $endPlace->delivery_price;
        }

        if($startTime->format("H")  < 8 || $startTime->format("H") > 19) {
            $deliveryPrice += $startPlace->extra_price;
        }


        if($endTime->format("H")  < 8 || $endTime->format("H") > 19) {
            $deliveryPriceBack += $endPlace->extra_price;
        }

        if($timeDiff > 2) {
            $dateDiff++;
        }

        if($dateDiff <= $startPlace->min_days && $deliveryPrice === 0) {
            $deliveryPrice += $startPlace->min_days_price;
        }
        if($dateDiff <= $endPlace->min_days && $request->start_place === $request->end_place) {
            $deliveryPriceBack += $endPlace->min_days_price;
        }

        $servicePrice = $this->serviceRepository->getTotalPriceFromArray(explode(',',$request->service, -1));

        if(!isset($carPrices[0])) {
            $priceLong = $car->price;
            $priceMedium = $car->price2;
            $price = $car->price3;

            if($dateDiff > 9) {
                $price = $priceLong;
            } else if($dateDiff > 3) {
                $price = $priceMedium;
            }

            $totalPrice = $price * $dateDiff + $servicePrice + $deliveryPrice + $deliveryPriceBack;
        } else {
            $carPrices = $this->carPriceRepository->getCarPricesById($id);
            $totalPrice = 0;
            if($startDate->year === $endDate->year ) {
                $year = $startDate->year;

                foreach ($carPrices as $key => $item) {
                    $carPrices[$key]->start = Carbon::parse($item->start)->setYear($year);
                    $carPrices[$key]->end = Carbon::parse($item->end)->setYear($year);
                    $carPrices[$key]->end = Carbon::parse($item->end)->setTime(23,59,59);
                }

                $custom = false;
                for ($day = Carbon::parse($dates[0]); $day->lessThan($endDate); $day->addDays(1)) {
                    foreach ($carPrices as $key => $item) {
                        $custom = false;
                        if($day->greaterThanOrEqualTo($item->start)
                                && $day->lessThanOrEqualTo($item->end)) {
                            if($dateDiff > 9) {
                                $totalPrice += $item->price;
                            } else if($dateDiff > 3) {
                                $totalPrice += $item->price2;
                            } else {
                                $totalPrice += $item->price3;
                            }
                            $custom = true;
                            break;
                        }
                    }
                    if($custom === false) {
                        if($dateDiff > 9) {
                            $totalPrice += $car->price;
                        } else if($dateDiff > 3) {
                            $totalPrice += $car->price2;
                        } else {
                            $totalPrice += $car->price3;
                        }
                    }
                }

            } else {
                $totalPrice = 0;
                foreach ($carPrices as $key => $item) {
                    $carPrices[$key]->end = Carbon::parse($item->end)->setTime(23,59,59);
                }
                $custom = false;
                for ($day = Carbon::parse($dates[0]); $day->lessThan($endDate); $day->addDays(1)) {
                    foreach ($carPrices as $key => $item) {
                        $custom = false;
                        $year = $day->year;
                        $item->start = Carbon::parse($item->start)->setYear($year);
                        $item->end = Carbon::parse($item->end)->setYear($year);
                        if($day->greaterThanOrEqualTo($item->start)
                                && $day->lessThanOrEqualTo($item->end)) {
                            if($dateDiff > 9) {
                                $totalPrice += $item->price;
                            } else if($dateDiff > 3) {
                                $totalPrice += $item->price2;
                            } else {
                                $totalPrice += $item->price3;
                            }
                            $custom = true;
                            break;
                        }
                    }
                    if($custom === false) {
                        if($dateDiff > 9) {
                            $totalPrice += $car->price;
                        } else if($dateDiff > 3) {
                            $totalPrice += $car->price2;
                        } else {
                            $totalPrice += $car->price3;
                        }
                    }
                }

            }
            $price = (int)floor($totalPrice / $endDate->diffInDays($startDate));
            $totalPrice = $price * $dateDiff + $servicePrice + $deliveryPrice + $deliveryPriceBack;
        }


        $startDate->setTime((int)$startTime->format("H"), (int)$startTime->format("i"));
        $endDate->setTime((int)$endTime->format("H"), (int)$endTime->format("i"));


        $order = Order::query()->create([
            'car_name' => $car->name,
            'price' => $price,
            'delivery_price' => $deliveryPrice,
            'delivery_price_back' => $deliveryPriceBack,
            'days' => $dateDiff,
            'total_price' => $totalPrice,
            'start_place_id' => $request->start_place,
            'end_place_id'=> $request->end_place,
            'start_at' => $startDate,
            'end_at' => $endDate,
            'name' => $request->name,
            'phone' => $request->phone,
            'comment' => $request->comment,
            'status' => 'check',
        ]);



        if($request->service !== null) {
            $order->services()->sync(explode(',',$request->service, -1));
        }

        Mail::to(['sigeti385@gmail.com', 'crimea-prokat@mail.ru'])->send(new OrderCreateMail($order));
//        Mail::to(['sigeti385@gmail.com'])->send(new OrderCreateMail($order));

        return response()->json(['result'=>'Мы скоро с вами свяжемся', 'created' => true]);
    }
}
