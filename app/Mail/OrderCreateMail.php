<?php

namespace App\Mail;

use App\Repositories\PlaceRepository;
use App\Repositories\ServiceRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderCreateMail extends Mailable
{
    use Queueable, SerializesModels;

    private $order;
    private $placeRepository;
    private $serviceRepository;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($order)
    {
        $this->order = $order;
        $this->placeRepository = app(PlaceRepository::class);
        $this->serviceRepository = app(ServiceRepository::class);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $order = $this->order;

        $services = $this->serviceRepository->getTotalPriceFromArray(array_keys($order->services->keyBy('id')->toArray()));
        $startPlace = $this->placeRepository->getNameById($order->start_place_id)->name;
        $endPlace = $this->placeRepository->getNameById($order->end_place_id)->name;

        $this->subject('Новый заказ #'.$order->id.' FoxRent - '.$order->car_name)
            ->from('link@foxrent.site', 'Foxrent.site' )
            ->view('ordermail', compact('order', 'startPlace',
                'startPlace', 'endPlace', 'services'));

    }
}
