@extends('layouts.user.user')

@section('title', 'Аренда авто в Симферополе и Крыму - FoxRent')
@section('h1', 'Аренда авто в Крыму')
@section('description', 'Аренда автомобилей в Крыму без водителя по низким ценам. Компания FoxRent предлагает большой ассортимент авто с доставкой в любую точку Крыма. Круглосуточная поддержка.')
@section('header-text', 'Делаем ваш отдых комфортным')

@section('head')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="canonical" href="{{route('home')}}"/>
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
                                            <source srcset="{{$images[$key][1]['uri']}}?{{$images[$key][1]['updated_at']}}" type="image/webp">
                                            <img src="{{$images[$key][0]['uri']}}?{{$images[$key][1]['updated_at']}}" alt="{{$car->name}}">
                                        @else
                                            <img src="/storage/orders/demo.jpg" alt="Demo car">
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
                    <h2 class="h2-black">Прокат автомобилей в Крыму</h2>
                </div>
                <div class="col-12">
                    <p class="p-text">Прокат автомобилей без водителей от компании «FoxRent» - это качественные услуги по аренде авто в Крыму. Автопарк кампании насчитывает более 50 автомобилей, где найдется авто для каждого клиента – эконом, бизнес или премиум класса. Подаем авто в любую точку Крыма, подача авто по Симферополю и в аэропорт – бесплатно. Наши вежливые сотрудники проконсультируют Вас и помогут выбрать авто именно под Ваши запросы и потребности.</p>
                    <p class="p-text">Создавая, нашу кампанию по прокату автомобилей, мы хотели учесть потребности и интересы Всех наших клиентов – туристов, курортников, бизнесменов, командированных, людей, столкнувшихся с временным отсутствием личных авто. Также в нашей кампании мы учитывали уникальное расположение нашего региона.</p>
                    <p class="p-text">Крым – уникальная и неповторимая жемчужина, омываемая берегами Черного моря. На этой территории насчитывается более 10 000 достопримечательностей, открытых для туристов и гостей полуострова. Гора Ай-Петри, Генуэзская крепость, Ливадийский дворец, Ласточкино гнездо, Большой каньон, Никитский ботанический сад и многое другое. Расположены достопримечательности в разных уголках Крыма. Аренда наших авто позволит Вам увидеть все вышеперечисленное и сделает Ваше путешествие по Крыму комфортным и запоминающимся. Вы самостоятельно планируете свой маршрут и получаете полную свободу передвижения.  Если Вы приехали или прилетели в Крым с целью деловой поездки, то для Вашего комфорта и создания делового имиджа - воспользуйтесь услугами нашего автопарка. Также владельцы собственных авто, которые находятся на ремонте, могут воспользоваться нашим автопарком, чтобы не менять уклад жизни и максимально комфортно пережить временные неудобства.</p>
                    <p class="p-text">Процедура получения автомобиля максимально проста и занимает около 10-15 минут. Чтобы взять машину в аренду, нужно предъявить паспорт и права. Представитель нашей кампании заранее подготовит документы и подаст транспорт к нужному времени и указанному в заявке адресу. Цена аренды авто у нас экономически обоснована, разумна и доступна для широкого круга пользователей.</p>
                    <p class="p-text">Выбрав аренду автомобиль в нашей кампании Вы останетесь довольны автомобилем, сервисом и персоналом. Почему Вы должны выбрать автомобиль именно в нашей кампании? Потому что наш принцип работы – сделать услугу по автопрокату – доступной, удобной, простой и максимально комфортной для каждого клиента.</p>
                </div>
            </div>
        </div>
    </section>
    @if(count($placeImages) > 0)

    <section class="section-item">
        <div class="container">
            <div class="row">
                <div class="col-12 pr0">
                    <div class="cat-container cat-container__place">
                        @foreach($placeImages as $key => $image)
                            <a href="{{route('page-place', [$places[$key]['slug']])}}" class="place-link">
                                <picture>
                                    <source srcset="{{ asset($image[2]['uri']) }}?{{$image[0]['updated_at']}}" media="(max-width: 575.98px)" type="image/webp">
                                    <source srcset="{{ asset($image[1]['uri']) }}?{{$image[0]['updated_at']}}" type="image/webp">
                                    <img src="{{asset($image[0]['uri'])}}?{{$image[0]['updated_at']}}" alt="{{$places[$key]['name']}}">
                                </picture>
                                <h3 class="place-title">{{$places[$key]['name']}}</h3>
                            </a>
                        @endforeach

                    </div>
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
    <section class="section-item">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 class="h2-black">Полезные статьи</h2>
                </div>
                @foreach($postImages as $key => $image)
                    <div class="col-lg-4">
                        <a href="{{route('user.post.show', [$posts[$key]['slug']])}}" class="post-link">
                            <div class="post-container">
                                <picture>
                                    <source srcset="{{ asset($image[1]['uri']) }}?{{$image[0]['updated_at']}}" type="image/webp">
                                    <img src="{{asset($image[0]['uri'])}}?{{$image[0]['updated_at']}}" alt="{{$posts[$key]['title']}}">
                                </picture>
                                <div class="post-title">{{$posts[$key]['title']}}</div>
                                <div class="post-date">{{date('d.m.Y', strtotime($posts[$key]['created_at']))}}</div>
                            </div>
                        </a>
                    </div>
                @endforeach

            </div>
        </div>
    </section>
@endsection
