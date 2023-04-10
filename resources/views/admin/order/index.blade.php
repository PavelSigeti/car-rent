@extends('layouts.dashboard')

@section('title', 'Заказы')

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
            <div class="col-12">
                <h1>Заказы</h1>
            </div>
            <div class="col-12">
                @foreach($orders as $order)
                    <a href="{{route('order.show', [$order->id])}}">
                        <div class="order">
                            <h4>Заказ: #{{$order->id}}</h4>
                            <p>Авто: {{$order->car_name}}</p>
                            <p>Всего по заказу: {{$order->total_price}}</p>
                        </div>
                    </a>
                @endforeach
            </div>
            <div class="col-12">
                {{ $orders->onEachSide(2)->links() }}
            </div>
        </div>
    </div>

@endsection

