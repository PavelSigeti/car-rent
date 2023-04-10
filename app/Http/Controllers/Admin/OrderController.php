<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderUpdateRequest;
use App\Repositories\OrderRepository;
use App\Repositories\PlaceRepository;
use App\Repositories\ServiceRepository;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    private $orderRepository;
    private $placeRepository;
    private $serviceRepository;

    public function __construct()
    {
        $this->orderRepository = app(OrderRepository::class);
        $this->placeRepository = app(PlaceRepository::class);
        $this->serviceRepository = app(ServiceRepository::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = $this->orderRepository->getPaginate(30);

        return view('admin.order.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = $this->orderRepository->getById($id);
        $services = $this->serviceRepository->getTotalPriceFromArray(array_keys($order->services->keyBy('id')->toArray()));
        $startPlace = $this->placeRepository->getNameById($order->start_place_id)->name;
        $endPlace = $this->placeRepository->getNameById($order->end_place_id)->name;


        return view('admin.order.show', compact('order', 'startPlace',
            'startPlace', 'endPlace', 'services'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(OrderUpdateRequest $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
