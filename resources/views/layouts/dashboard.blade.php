<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1.0, width=device-width">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <meta name="robots" content="noindex" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="shortcut icon" href="{{ asset('img/svg/ico-admin.svg') }}">


    <link  href="{{ asset('libs/date/hotel-datepicker.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('styles/admin.css?280422') }}">
    <link rel="stylesheet" href="{{ asset('styles/admin-media.css?280422') }}">
    <title>@yield('title')</title>
    @yield('head')
</head>
<body>
    <div class="dark-back"></div>
<header>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-header">
                <nav class="main-menu">
                    <ul>
                        <li><a href="{{route('dashboard')}}">Главная</a></li>
                        <li><a href="{{route('car.index')}}">Автомобили</a></li>
                        <li><a href="{{route('meta.index')}}">Фильтры автомобилей</a></li>
                        <li><a href="{{route('service.index')}}">Доп. услуги</a></li>
                        <li><a href="{{route('place.index')}}">Точки доставки</a></li>
                        <li><a href="{{route('page.index')}}">Страницы</a></li>
                        <li><a href="{{route('post.index')}}">Записи</a></li>
                        <li><a href="{{route('order.index')}}">Заказы</a></li>
                        <li><a href="{{route('setting.index')}}">Настройки</a></li>
                    </ul>
                    <div class="exit"></div>
                </nav>
                <div class="bars"></div>
            </div>
        </div>
    </div>
</header>
<main>
    @yield('before-content')
    @yield('content')
    @yield('after-content')
</main>
<footer>

</footer>
@yield('scripts')
<script src="{{ asset('libs/date/fecha.min.js') }}"></script>
<script src={{ asset('libs/date/hotel-datepicker.min.js') }}></script>
<script src="{{ asset('js/admin.js?280422') }}"></script>
</body>
</html>
