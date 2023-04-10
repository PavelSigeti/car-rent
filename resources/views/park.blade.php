@extends('layouts.user.park')

@section('title', 'Автомобили - FoxRent')
@section('h1', 'Автомобили')
@section('description', 'Автомобили компании FoxRent Крым')
{{--@section('header-text', 'Делаем ваш отдых комфортным')--}}

@section('head')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')
    @include('includes.car-categories')
    <section class='section-item'>
        <div class="container">
            <div class="row fetch-after">
                <div class="col-12">
                    <h2 class="h2-black">Наш автопарк</h2>
                </div>
                @foreach($cars as $key => $car)
                    <div class="col-xl-4 col-md-6">
                        <a href="{{route('user.car.show', [$car->slug])}}">
                            <div class="car-item">
                                <div class="car-tag__container">
                                    @if($car->home_place !== null)
                                        <div class="car-tag"><img src="{{ asset('img/svg/mappoint.svg') }}" alt="точка карты">{{$places[$car->home_place]['name']}}</div>
                                    @endif
                                    @if($car->discount !== null)
                                        <div class="car-tag">{{$car->discount}}</div>
                                    @endif
                                </div>
                                <div class="car-image">
                                    <picture>
                                        @isset($images[$key][0]['uri'])
                                            <source srcset="{{$images[$key][1]['uri']}}?{{$images[$key][0]['updated_at']}}" type="image/webp">
                                            <img src="{{$images[$key][0]['uri']}}?{{$images[$key][0]['updated_at']}}" alt="{{$car->name}}">
                                        @else
                                            <img src="/storage/orders/demo.jpg" alt="">
                                        @endisset
                                    </picture>
                                    <meta content="автомобиль {{$car->name}}">
                                </div>
                                <div class="car-content">
                                    <span class="car-name">{{$car['name']}}</span>
                                    <div class="car-meta">
                                        @foreach($car->metas as $meta)
                                            @if($meta->type == 'transmission' || $meta->type == 'body')<span class="car-meta__item">{{$meta->name}}</span> @endif
                                        @endforeach
                                        <span class="car-meta__item">{{$car->seats}} мест</span>
                                    </div>
                                    <div class="car-content__bottom">
                                        <span class="car-price">от {{$car->car_price}} руб.</span>
                                        <div class="car-content__btn">Забронировать</div>
                                    </div>
                                </div>

                            </div>
                        </a>
                    </div>
                @endforeach
            </div>

        </div>
    </section>

@endsection

@section('after-content')
    <section class="section-item">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 class="h2-black">Условия аренды</h2>
                </div>
                <div class="col-12">
                    <p class="p-text">
                        Условия аренды авто в городе Симферополь (Крым) и цены на неё зависят от марки и класса машины (хетчбек, седан, кроссовер), года выпуска и выбранных опций. Доставка автомобилей по городам Крыма (кроме Симферополя) осуществляется за дополнительную плату.
                    </p>
                    <p><strong>Эксплуатация автомобиля за пределами Крыма</strong> - возможна по индивидуальному тарифу.</p>
                    <h4 class="h4-black">
                        Требования к водителю:
                    </h4>
                    <p class="p-text">
                        Минимальный возраст водителя — <strong>21 год</strong>, минимальный стаж водителя — <strong>2 года</strong>. При аренде премиум авто марок: Audi, BMW, Mercedes, Porsche, Cadillac, Lexus, Range Rover, автомобилей из категории Бизнес, возраст водителя должен быть не менее 25 лет и стаж вождения не менее 3 лет.
                    </p>
                    <h4 class="h4-black">
                        Необходимые документы:
                    </h4>
                    <p class="p-text">
                        Для граждан РФ: гражданский паспорт и водительское удостоверение РФ.
                    </p>
                    <p class="p-text">
                        Для иностарнных граждан: паспорт гражданина международного образца и водительское удостоверение.
                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection
