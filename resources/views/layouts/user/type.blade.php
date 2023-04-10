<!doctype html>
<html lang="ru">
<head itemscope itemtype="http://schema.org/WPHeader">
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1.0, width=device-width">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="shortcut icon" href="{{ asset('img/svg/ico.svg') }}">

    <link  href="{{ asset('libs/date/hotel-datepicker.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('styles/style.css?260722') }}">
    <link rel="stylesheet" href="{{ asset('/styles/media.css?260722') }}">
    <title itemprop="headline">@yield('title')</title>
    <meta name="description" content="@yield('description')">


    <meta property="og:locale" content="ru_RU" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="@yield('title')" />
    <meta property="og:description" content="@yield('description')" />
    <meta property="og:url" content="{{Request::url()}}" />
    <meta property="og:site_name" content="FoxRent" />
    <meta property="og:image" content="{{ asset('img/foxrent.jpg') }}" />
    <meta property="og:image:type" content="image/jpeg" />

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-6YMK9P3CF5"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-6YMK9P3CF5');
    </script>

    @yield('head')
</head>
<body>
<div class="dark-back"></div>
<header style="background-image: url('{{ asset('img/type.jpg') }}');" class="header-default">
    <div class="container">
        <div class="header-top">
            <div class="container">
                <div class="row header-top__center">
                    <div class="col-lg-2 col-6">
                        <a href="/" class="logo-header__link">
                            <img src="{{ asset('img/svg/logo-white.svg') }}" alt="Logo Foxrent" class="logo-img">
                        </a>
                    </div>
                    <div class="col-lg-8 header-menu">
                <div class="menu-close show-992">
                    <span>Меню</span>
                    <div class="menu-close-btn">Закрыть</div>
                </div>
                <nav>
                    <ul class="main-menu" itemscope itemtype="http://schema.org/SiteNavigationElement">
                        @include('includes.nav-header')
                    </ul>
                </nav>
                <div class="mobi-menu-contacts">
                    <a href="tel:{{$settings['phone_link']->value}}" class="mobi-menu_tel">
                        <img src="{{ asset('img/svg/call.svg') }}" alt="иконка телефона">
                        {{$settings['phone']->value}}
                    </a>
                    <div class="mobi-menu_messangers">
                        <div class="mobi-menu_msg-item">
                            <a href="{{$settings['whatsapp']->value}}" class="messenger-link whatsapp-link" target="_blank"><img src="{{ asset('img/svg/whatsapp.svg') }}" alt="WhatsApp"></a>
                        </div>
                        <div class="mobi-menu_msg-item">
                            <a href="{{$settings['viber']->value}}" class="messenger-link viber-link" target="_blank"><img src="{{ asset('img/svg/viber.svg') }}" alt="Viber"></a>
                        </div>
                        <div class="mobi-menu_msg-item">
                            <a href="{{$settings['tg']->value}}" class="messenger-link tg-link" target="_blank"><img src="{{ asset('img/svg/tg.svg') }}" alt="Viber"></a>
                        </div>
                    </div>
                </div>
            </div>
                    <div class="col-lg-2 header-phone hide-992"><a href="tel:{{$settings['phone_link']->value}}">{{$settings['phone']->value}}</a>
                    </div>
                    <div class="col-6 show-992 menu-header-button__container">
                        <div class="menu-header-button">
                            <span class="bars"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 header-main__content">
                <h1 class="h1-white">@yield('h1')</h1>
                @yield('bread')
            </div>
        </div>
    </div>
</header>
<main>
    @yield('before-content')
    @yield('content')
    @yield('after-content')
</main>
@include('includes.footer')
</body>
</html>
