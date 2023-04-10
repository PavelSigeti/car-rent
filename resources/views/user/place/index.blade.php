@extends('layouts.user.place')

@section('title', $place->seo_title)
@section('h1', $place->title)
@section('description', $place->seo_description)
@section('bread', '')
@section('head')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="canonical" href="{{route('page-place', [$place->slug])}}"/>
@endsection
@section('content')
    <section class="section-item">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 class="h2-black">Категории автомобилей</h2>
                </div>
                <div class="col-12 pr0">
                    <div class="cat-container">
                        <div class="cat-item__container">
                            <a href="{{route('meta.show', ['class', 'ekonom'])}}">
                                <div class="cat-item">
                                    <div class="cat-item__img">
                                        <picture>
                                            <source srcset="{{ asset('img/cat/ekonom_s.webp') }}" media="(max-width: 575.98px)" type="image/webp">
                                            <source srcset="{{ asset('img/cat/ekonom_s.jpg') }}" media="(max-width: 575.98px)" type="image/jpg">
                                            <source srcset="{{ asset('img/cat/ekonom.webp') }}" type="image/webp">
                                            <img src="{{asset('img/cat/ekonom.jpg')}}" alt="Эконом авто хундай">
                                        </picture>
                                    </div>
                                    <div class="cat-item__title">Эконом</div>
                                </div>
                            </a>
                        </div>
                        <div class="cat-item__container">
                            <a href="{{route('meta.show', ['class', 'biznes'])}}">
                                <div class="cat-item">
                                    <div class="cat-item__img">
                                        <picture>
                                            <source srcset="{{ asset('img/cat/biz_s.webp') }}" media="(max-width: 575.98px)" type="image/webp">
                                            <source srcset="{{ asset('img/cat/biz_s.jpg') }}" media="(max-width: 575.98px)" type="image/jpg">
                                            <source srcset="{{ asset('img/cat/biz.webp') }}" type="image/webp">
                                            <img src="{{asset('img/cat/biz.jpg')}}" alt="Бизнес авто BMW">
                                        </picture>
                                    </div>
                                    <div class="cat-item__title">Бизнес</div>
                                </div>
                            </a>
                        </div>
                        <div class="cat-item__container">
                            <a href="{{route('meta.show', ['class', 'premium'])}}">
                                <div class="cat-item">
                                    <div class="cat-item__img">
                                        <picture>
                                            <source srcset="{{ asset('img/cat/prem_s.webp') }}" media="(max-width: 575.98px)" type="image/webp">
                                            <source srcset="{{ asset('img/cat/prem_s.jpg') }}" media="(max-width: 575.98px)" type="image/jpg">
                                            <source srcset="{{ asset('img/cat/prem.webp') }}" type="image/webp">
                                            <img src="{{asset('img/cat/prem.jpg')}}" alt="Премиум авто Mercedes">
                                        </picture>
                                    </div>
                                    <div class="cat-item__title">Премиум</div>
                                </div>
                            </a>
                        </div>
                        <div class="cat-item__container">
                            <a href="{{route('meta.show', ['body', 'kabriolet'])}}">
                                <div class="cat-item">
                                    <div class="cat-item__img">
                                        <picture>
                                            <source srcset="{{ asset('img/cat/cabrio_s.webp') }}" media="(max-width: 575.98px)" type="image/webp">
                                            <source srcset="{{ asset('img/cat/cabrio_s.jpg') }}" media="(max-width: 575.98px)" type="image/jpg">
                                            <source srcset="{{ asset('img/cat/cabrio.webp') }}" type="image/webp">
                                            <img src="{{asset('img/cat/cabrio.jpg')}}" alt="Кабриолет BMW">
                                        </picture>
                                    </div>
                                    <div class="cat-item__title">Кабриолет</div>
                                </div>
                            </a>
                        </div>
                        <div class="cat-item__container">
                            <a href="{{route('meta.show', ['body', 'vnedoroznik'])}}">
                                <div class="cat-item">
                                    <div class="cat-item__img">
                                        <picture>
                                            <source srcset="{{ asset('img/cat/cross_s.webp') }}" media="(max-width: 575.98px)" type="image/webp">
                                            <source srcset="{{ asset('img/cat/cross_s.jpg') }}" media="(max-width: 575.98px)" type="image/jpg">
                                            <source srcset="{{ asset('img/cat/cross.webp') }}" type="image/webp">
                                            <img src="{{asset('img/cat/cross.jpg')}}" alt="Внедорожник Honda">
                                        </picture>
                                    </div>
                                    <div class="cat-item__title">Внедорожник</div>
                                </div>
                            </a>
                        </div>
                        <div class="cat-item__container">
                            <a href="{{route('meta.show', ['body', 'miniven'])}}">
                                <div class="cat-item">
                                    <div class="cat-item__img">
                                        <picture>
                                            <source srcset="{{ asset('img/cat/ven_s.webp') }}" media="(max-width: 575.98px)" type="image/webp">
                                            <source srcset="{{ asset('img/cat/ven_s.jpg') }}" media="(max-width: 575.98px)" type="image/jpg">
                                            <source srcset="{{ asset('img/cat/ven.webp') }}" type="image/webp">
                                            <img src="{{asset('img/cat/ven.jpg')}}" alt="Минивэн Opel">
                                        </picture>
                                    </div>
                                    <div class="cat-item__title">Минивэн</div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <section class='section-item'>
        <div class="container" id="place-container" data-place="{{$place->id}}">
            <div class="row fetch-after">
                <div class="col-12">
                    <h2 class="h2-black">Автомобили</h2>
                </div>
                @foreach($cars as $key => $car)
                    <div class="col-xl-4 col-md-6">
                        <a href="{{route('user.car.show', [$car->slug])}}?place={{$place->id}}">
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
                                        <span class="car-price">от
                                            @isset($car->prices[0])
                                                @if($car->prices->min('price') < $car->price){{$car->prices->min('price')}}@else{{$car->price}}@endif
                                            @else{{$car->price}}
                                            @endisset
                                                руб.</span>
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
    @if(strlen($place->big_text) > 1)
        <section class="section-item text-section">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        {!! $place->big_text !!}
                    </div>
                </div>
            </div>
        </section>
    @endif
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
