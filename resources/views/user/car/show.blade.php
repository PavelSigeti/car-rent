@extends('layouts.user.car')

@section('title', $car->seo_title)
@section('description', $car->seo_description)
@section('head')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @isset($carImages[0][0]['uri'])
        <meta property="og:image" content="{{ url($carImages[0][0]['uri']) }}" />
    @else
        <meta property="og:image" content="/storage/orders/demo.jpg" />
    @endisset
    <meta property="og:image:type" content="image/jpeg" />
    <link rel="stylesheet" href="{{ asset('libs/select/nice-select2.css') }}">
    <link rel="stylesheet" href="{{ asset('libs/viewer/viewer.min.css') }}">

    <link rel="canonical" href="{{route('user.car.show', [$car->slug])}}"/>
@endsection

@section('content')

    @if($errors->any())
        <ul class="errors-container">
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    @endif
    <div class="dark-back-car"></div>
    <div class="dark-back"></div>
    <div class="container" id="car-page" itemscope itemtype="http://schema.org/Product">
        <div class="row">
            <div class="col-12">
                <ul class="breadcrumbs">
                    <li><a href="/">Главная</a></li>
                    <li><a href="{{route('meta.show', ['brand', $car->metas->where('type', 'brand')->first()->slug])}}">{{$car->metas->where('type', 'brand')->first()->name}}</a></li>
                    <li><span>{{$car->name}}</span></li>
                </ul>
            </div>
            <div class="col-12">
                <div class="grid-container">
                    <div class="grid-main">
                        <div class="car-image__slider swiper">
                            <div class="swiper-wrapper" id="car_viewer">
                                @if(count($carImages) > 0)
                                    @foreach($carImages as $image)
                                        <div class="swiper-slide">
                                            <picture>
                                                <source srcset="{{$image[1]['uri']}}?{{$image[0]['updated_at']}}" type="image/webp">
                                                <img src="{{$image[0]['uri']}}?{{$image[0]['updated_at']}}" alt="{{$car->name}}" @if($loop->index == 0) itemprop="image" @endif>
                                            </picture>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="swiper-slide">
                                        <picture>
                                            <img src="/storage/orders/demo.jpg" alt="">
                                        </picture>
                                    </div>
                                @endisset
                            </div>
                            @if(count($carImages) > 1)
                            <div class="slider-nav__container">
                                <div class="swiper-button-prev slider-nav__item"><img src="{{ asset('img/svg/arrow-left.svg') }}" alt="arrow"></div>
                                <div class="swiper-button-next slider-nav__item"><img src="{{ asset('img/svg/arrow-right.svg') }}" alt="arrow"></div>
                            </div>
                            @endif
                        </div>
                        <h1 class="car-title" itemprop="name">{{$car->name}}</h1>
                        @if($car->home_place)
                            <div class="home-place-alert">Данный автомобиль можно получить только в городе {{$places->find($car->home_place)->name}}</div>
                        @endif
                        @isset($carPrices[0])
                            <div class="price-table" id="price-table" itemscope itemprop="offers" itemtype="http://schema.org/AggregateOffer">
                                <meta content="{{$car->car_price}}" itemprop="lowPrice"/>
                                <meta itemprop="priceCurrency" content="RUB">
                                <div class="price-table__head">
                                    <div class="price-table__item">Период</div>
                                    <div class="price-table__item">2-3 дня</div>
                                    <div class="price-table__item">4-9 дней</div>
                                    <div class="price-table__item">10+ дней</div>
                                </div>
                                <div class="price-table__content">
                                    <div class="price-table__item">25.12 - 10.01</div>
                                    <div class="price-table__item">{{$car->price3}} <span class="hide-price__item">руб.</span><span class="show-price__item">р.</span></div>
                                    <div class="price-table__item">{{$car->price2}} <span class="hide-price__item">руб.</span><span class="show-price__item">р.</span></div>
                                    <div class="price-table__item">{{$car->price}} <span class="hide-price__item">руб.</span><span class="show-price__item">р.</span></div>
                                </div>
                                @foreach($carPrices as $carPrice)
                                <div class="price-table__content">
                                    <div class="price-table__item">{{\Illuminate\Support\Carbon::parse($carPrice->start)->format('d.m')}} - {{\Illuminate\Support\Carbon::parse($carPrice->end)->format('d.m')}}</div>
                                    <div class="price-table__item">{{$carPrice->price3}} <span class="hide-price__item">руб.</span><span class="show-price__item">р.</span></div>
                                    <div class="price-table__item">{{$carPrice->price2}} <span class="hide-price__item">руб.</span><span class="show-price__item">р.</span></div>
                                    <div class="price-table__item">{{$carPrice->price}} <span class="hide-price__item">руб.</span><span class="show-price__item">р.</span></div>
                                </div>
                                @endforeach
                            </div>
                        @else
                            <div id="price-list" class="price-list" itemscope itemprop="offers" itemtype="http://schema.org/AggregateOffer">
                                <div class="price-list__item price-list__item-active price-list__item-short">
                                    <span class="price-list__item-title">2-3 дня:</span>
                                    <span><span class="price-list__item-amount price-short">{{$car->price3}}</span>руб.</span>
                                    <div class="price-list__item-indicator"></div>
                                </div>
                                <div class="price-list__item price-list__item-medium">
                                    <span class="price-list__item-title">4-9 дней:</span>
                                    <span><span class="price-list__item-amount price-medium">{{$car->price2}}</span>руб.</span>
                                    <div class="price-list__item-indicator"></div>
                                </div>
                                <div class="price-list__item price-list__item-long">
                                    <span class="price-list__item-title">10+ дней:</span>
                                    <span><span class="price-list__item-amount price-long">{{$car->price}}</span>руб.</span>
                                    <div class="price-list__item-indicator"></div>
                                </div>
                                <meta content="{{$car->price}}" itemprop="lowPrice"/>
                                <meta itemprop="priceCurrency" content="RUB">
                            </div>
                        @endisset
                    </div>
                    <div class="grid-sidebar">
                        @isset($car->msg)
                            <div class="car-msg">
                                {{$car->msg}}
                            </div>
                        @endisset
                        <div class="order-form-container">
                            <div class="car-price__container">
                                <span class="car-price__old"></span>
                                <span class="car-price__current">@isset($car->prices[0])
                                        @if($car->prices->min('price') < $car->price){{$car->prices->min('price')}}@else{{$car->price}}@endif
                                    @else{{$car->price}}
                                    @endisset</span>
                                руб.<span class="car-price__days">/сутки</span>
                            </div>

                            <form action="{{route('order.store', [$car->id])}}" method="post" id="order-form">
                                @csrf
                                <div class="order-values">
                                    <div class="order-input__container">
                                        <label for="input-id">Даты бронирования</label>
                                        <input id="input-id" name="date" type="text" value="{{$datePicker}}" readonly>
                                    </div>
                                    <div class="order-select__container">
                                        <label for="start_place">Начало</label>
                                        @if($car->home_place !== NULL)
                                            <div class="place-selector-default" data-id="{{$car->home_place}}">{{$places->find($car->home_place)->name}}</div>
                                        @else
                                            <select name="start_place" id="start_place" class="place-selector">
                                                @foreach($places as $place)
                                                    <option value="{{$place->id}}" @if($place->id == request()->get('place')) selected @elseif($loop->first && request()->get('place') == null) selected @endif>{{$place->name}}</option>
                                                @endforeach
                                            </select>
                                        @endif
                                        <select name='start_time' id='start_time' class="time-selector">
                                            @for($i = 0; $i < 24; $i++)
                                                <option value="{{str_pad($i, 2, '0', STR_PAD_LEFT)}}:00" @if($i === 12) selected @endif>{{str_pad($i, 2, '0', STR_PAD_LEFT)}}:00</option>
                                                <option value="{{str_pad($i, 2, '0', STR_PAD_LEFT)}}:30">{{str_pad($i, 2, '0', STR_PAD_LEFT)}}:30</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="order-select__container">
                                        <label for="start_place">Завершение</label>
                                        <select name="end_place" id="end_place" class="place-selector">
                                            @if($car->home_place)
                                                @foreach($places as $place)
                                                    <option value="{{$place->id}}" @if($place->id === $car->home_place) selected @endif>{{$place->name}}</option>
                                                @endforeach
                                            @else
                                                @foreach($places as $place)
                                                    <option value="{{$place->id}}" @if($loop->first) selected @endif>{{$place->name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <select name='end_time' id='end_time' class="time-selector">
                                            @for($i = 0; $i < 24; $i++)
                                                <option value="{{str_pad($i, 2, '0', STR_PAD_LEFT)}}:00" @if($i === 12) selected @endif>{{str_pad($i, 2, '0', STR_PAD_LEFT)}}:00</option>
                                                <option value="{{str_pad($i, 2, '0', STR_PAD_LEFT)}}:30">{{str_pad($i, 2, '0', STR_PAD_LEFT)}}:30</option>
                                            @endfor
                                        </select>
                                    </div>

                                    <div id="list1" class="dropdown-check-list" tabindex="100">
                                        <span class="dropdown-check-list__label">Доп. улсуги</span>
                                        <span class="anchor" id="service-input__text">Нет выбранных доп. услуг</span>
                                        <ul class="items" id="service-container">
                                            @foreach($services as $service)
                                                <li><input id="service-item__id-{{$service->id}}" class="service-item" type="checkbox" data-price="{{$service->price}}" name="service[{{$service->id}}]" value="{{$service->id}}"><label
                                                        for="service-item__id-{{$service->id}}">{{$service->name}} +{{$service->price}} руб.</label></li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>

                                <div id="checkout-button" class="order-button">Забронировать</div>
                                <div class="price-checkout">
                                    <div class="price-item"><span class="price-item__name" id="price-item__day-count"></span><span class="price-item__amount"><span id="day_count">0</span> руб.</span></div>
                                    <div class="price-item"><span class="price-item__name">Доп. услуги: </span><span class="price-item__amount"><span id="services_price">0</span> руб.</span></div>
                                    <div class="price-item"><span class="price-item__name">Доставка при получении: </span><span class="price-item__amount"><span id="delivery_price">0</span> руб.</span></div>
                                    <div class="price-item"><span class="price-item__name">Доставка при сдаче: </span><span class="price-item__amount"><span id="delivery_price_back">0</span> руб.</span></div>
                                    <div class="price-item price-item__total"><span class="price-item__name">Итого: </span><span class="price-item__amount-total"><span id="rent-total_price">0</span> руб.</span></div>
                                    @isset($car->zalog)
                                        <div class="price-item"><span class="price-item__name">Залог: </span><span class="price-item__amount">{{$car->zalog}} руб.</span></div>
                                    @endisset
                                </div>
                                <div class="order-contact__container order-values">
                                    <div class="order-contact__container-inside">
                                        <div class="order-contact__close">
                                            <span>Бронирование</span>
                                            <div class="order-contact__close-btn">Закрыть</div>
                                        </div>
                                        <div class="order-main-info">
                                            <div class="order-main-info__name">{{$car->name}}</div>
                                            <div class="order-main__delivery order-main__delivery-item">Получение:
                                                <span class="order-main__start-place"></span>
                                            </div>
                                            <div class="order-main__delivery-back order-main__delivery-item">Возврат:
                                                <span class="order-main__end-place"></span>
                                            </div>
                                        </div>
                                        <div class="order-input__container">
                                            <label for="user-name">Имя</label>
                                            <input type="text" name="name" id="user-name" placeholder="Имя" autocomplete="off">
                                        </div>
                                        <div class="order-input__container">
                                            <label for="user-phone">Телефон</label>
                                            <input type="tel" name="phone" placeholder="Телефон" id="user-phone" autocomplete="off">
                                        </div>
                                        <div class="order-input__container">
                                            <label for="user-name">Комментарий</label>
                                            <textarea name="comment" placeholder="Комментарий" autocomplete="off"></textarea>
                                        </div>

                                        <button id="order-submit" class="order-button">Забронировать</button>
                                        <div class="load-order loader-hide"><img src="{{ asset('img/svg/loader.svg') }}" alt="loader"></div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="banner-item">
                            <div class="banner-item__img">
                                <span class="banner-item__circle"></span>
                                <img src="{{ asset('img/svg/compass.svg') }}" alt="Компас">
                            </div>
                            <div class="banner-itme__content">Без ограничений пробега</div>
                        </div>
                        <div class="banner-item">
                            <div class="banner-item__img">
                                <span class="banner-item__circle"></span>
                                <img src="{{ asset('img/svg/shield.svg') }}" alt="Щит">
                            </div>
                            <div class="banner-itme__content">КАСКО, ОСАГО, страхование</div>
                        </div>
                        <div class="banner-item">
                            <div class="banner-item__img">
                                <span class="banner-item__circle"></span>
                                <img src="{{ asset('img/svg/support.svg') }}" alt="Поддержка">
                            </div>
                            <div class="banner-itme__content">Круглосуточная поддержка</div>
                        </div>

                    </div>
                    <div class="grid-content">
                        <h3 class="h3-black">Характеристики</h3>
                        <div class="metas" itemprop="description">
                            @foreach($car->metas as $meta)
                            <div class="meta-item">
                               <div class="meta-item__name">{{$meta->title}}</div>
                               <div class="meta-item__value">{{$meta->name}}</div>
                           </div>
                            @endforeach
                           <div class="meta-item">
                               <div class="meta-item__name">Вместительность</div>
                               <div class="meta-item__value">{{$car->seats}}</div>
                           </div>
                           @isset($car->engine)
                           <div class="meta-item">
                               <div class="meta-item__name">Двигатель</div>
                               <div class="meta-item__value">{{$car->engine}}</div>
                           </div>
                           @endisset
                            @isset($car->year)
                                <div class="meta-item">
                                    <div class="meta-item__name">Год</div>
                                    <div class="meta-item__value">{{$car->year}}</div>
                                </div>
                            @endisset
                        </div>
                        @if(strlen($car->seo_text) > 1)
                        <div class="text-section mt30">
                            {!! $car->seo_text !!}
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-12">
                <h3 class="h3-black">Похожие автомобили</h3>
            </div>
            @foreach($same as $key => $car)
                    <div class="col-xl-4 col-md-6">
                        <a href="{{route('user.car.show', [$car->slug])}}">
                            <div class="car-item">
                                <div class="car-image">
                                    <picture>
                                        @isset($images[$key][0]['uri'])
                                            <source srcset="{{$images[$key][1]['uri']}}?{{$images[$key][0]['updated_at']}}" type="image/webp">
                                            <img src="{{$images[$key][0]['uri']}}?{{$images[$key][0]['updated_at']}}" alt="{{$car->name}}">
                                        @else
                                            <img src="/storage/orders/demo.jpg" alt="">
                                        @endisset
                                    </picture>
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
                                        <span class="car-price">от {{$car->car_price}}руб.</span>
                                        <div class="car-content__btn">Забронировать</div>
                                    </div>
                                </div>

                            </div>
                        </a>
                    </div>
                @endforeach
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        let placeData = {!! json_encode($placeData) !!};
        let carDefaultPrice = {!! json_encode($carDefaultPrice) !!};
        let carPrices = {!! json_encode($carPrices) !!};
    </script>
    <script src="{{ asset('libs/select/nice-select2.js') }}"></script>
    <script src="{{ asset('libs/date/fecha.min.js') }}"></script>
    <script src={{ asset('libs/date/hotel-datepicker.min.js') }}></script>
    <script src={{ asset('js/car.js?28042022') }}></script>
@endsection
