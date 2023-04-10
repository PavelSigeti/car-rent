@extends('layouts.dashboard')

@section('title', 'Контроль панель')

@section('head')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{ asset('libs/select/nice-select2.css') }}">
@endsection

@section('content')

    @if($errors->any())
        <ul class="errors-container">
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    @endif
<div class="container-fluid">
    <div class="row">
        <div class="col-12"><a href="{{route('order.index')}}">К заказам</a></div>
        <div class="col-12">
            <h1>Заказ #{{$order->id}}, {{$order->car_name}}</h1>
        </div>
        <div class="col-12">
            <div id="car-page" class="order-page" data-price="{{$order->price}}">
                <table style="margin:0; padding:0">
                    <tr>
                        <td>Авто:</td>
                        <td>{{$order->car_name}}</td>
                    </tr>
                    <tr>
                        <td>Начало:</td>
                        <td>{{$startPlace.' - '.DateTime::createFromFormat('Y-m-d H:i:s', $order->start_at)->format('d-m-Y H:i:s')}}</td>
                    </tr>
                    <tr>
                        <td>Конец:</td>
                        <td>{{$endPlace.' - '.DateTime::createFromFormat('Y-m-d H:i:s', $order->end_at)->format('d-m-Y H:i:s')}}</td>
                    </tr>
                    <tr>
                        <td>Цена за сутки:</td>
                        <td>{{$order->price}}</td>
                    </tr>
                    <tr>
                        <td>Кол-во суток:</td>
                        <td>{{$order->days}}</td>
                    </tr>
                    <tr>
                        <td>Доставка:</td>
                        <td>{{$order->delivery_price}}</td>
                    </tr>
                    <tr>
                        <td>Доставка возврат:</td>
                        <td>{{$order->delivery_price_back}}</td>
                    </tr>
                    @if(count($order->services) > 0)
                        <tr>
                            <td>Доп.услуги:</td>
                            <td>@foreach($order->services as $item) {{$item->name}}; @endforeach</td>
                        </tr>
                        <tr>
                            <td>Цена за доп.услуги:</td>
                            <td>{{$services}}</td>
                        </tr>
                    @endif
                    <tr>
                        <td>Имя:</td>
                        <td>{{$order->name}}</td>
                    </tr>
                    <tr>
                        <td>Телефон:</td>
                        <td>{{$order->phone}}</td>
                    </tr>
                    <tr>
                        <td>Комментарий:</td>
                        <td>{{$order->comment}}</td>
                    </tr>
                    <tr>
                        <td><b>Всего по заказу:</b></td>
                        <td><b>{{$order->total_price}}</b></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
    <script src="{{ asset('libs/select/nice-select2.js') }}"></script>
@endsection
