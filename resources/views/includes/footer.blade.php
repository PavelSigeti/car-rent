<footer>
    <div class="container" itemscope itemtype="http://schema.org/Organization">
        <meta itemprop="image" content="{{ asset('img/foxrent.jpg') }}">
        <div class="row">
            <div class="col-lg-4 footer-item">
                <meta itemprop="name" content="FoxRent">
                <div class="footer-phone" itemprop="telephone"><a href="tel:{{$settings['phone_link']->value}}">{{$settings['phone']->value}}</a></div>
                @if($settings['phone2']->value)
                    <div class="footer-phone" itemprop="telephone"><a href="tel:{{$settings['phone2_link']->value}}">{{$settings['phone2']->value}}</a></div>
                @endif
                <div class="footer-email" itemprop="email">
                    {{$settings['email']->value}}
                </div>
                <div class="footer-address" itemprop="address" itemscope itemtype="https://schema.org/PostalAddress">
                    <span itemprop="streetAddress">{{$settings['address']->value}}</span>
                </div>
                <div class="contact_messangers">
                    <div class="contact_msg-item">
                        <a href="{{$settings['whatsapp']->value}}" class="contact_messenger-link whatsapp-link" target="_blank"><img src="{{ asset('img/svg/whatsapp.svg') }}" alt="WhatsApp"></a>
                    </div>
                    <div class="contact_msg-item">
                        <a href="{{$settings['viber']->value}}" class="contact_messenger-link viber-link" target="_blank"><img src="{{ asset('img/svg/viber.svg') }}" alt="Viber"></a>
                    </div>
                    <div class="contact_msg-item">
                        <a href="{{$settings['tg']->value}}" class="contact_messenger-link tg-link" target="_blank"><img src="{{ asset('img/svg/tg.svg') }}" alt="Viber"></a>
                    </div>
                </div>
                <ul class="soc-footer">
                    @if(strlen($settings['vk_link']->value) > 1)<li><a href="{{$settings['vk_link']->value}}" target="_blank"><img src="{{asset('img/svg/vk.svg')}}" alt="VK" class="soc-img"></a></li>@endif
                    @if(strlen($settings['inst_link']->value) > 1)<li><a href="{{$settings['inst_link']->value}}" target="_blank"><img src="{{asset('img/svg/inst.svg')}}" alt="Instagram" class="soc-img"></a></li>@endif
                    @if(strlen($settings['fb_link']->value) > 1)<li><a href="{{$settings['fb_link']->value}}" target="_blank"><img src="{{asset('img/svg/fb.svg')}}" alt="Facebook" class="soc-img"></a></li>@endif
                    @if(strlen($settings['tw_link']->value) > 1)<li><a href="{{$settings['tw_link']->value}}" target="_blank"><img src="{{asset('img/svg/twitter.svg')}}" alt="Twitter" class="soc-img"></a></li>@endif
                </ul>
            </div>
            <div class="col-lg-4 footer-item">
                <div class="footer-link__container">
                    <div class="footer-link__container-title">Полезные ссылки</div>
                    <ul class="footer-menu">
                        <li><a href="/">Главная</a></li>
                        <li><a href="{{route('car')}}">Автомобили</a></li>
                        <li><a href="{{route('page-place', ['usloviya-arendy'])}}">Условия аренды</a></li>
                        <li><a href="{{route('page-place', ['contacts'])}}">Контакты</a></li>
                        <li><a href="{{route('page-place', ['about'])}}">О нас</a></li>
                        <li><a href="{{route('user.post.index')}}">Блог</a></li>
                        <li><a href="/transfer">Трансферы</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 footer-item">
                <div class="footer-link__container">
                    <div class="footer-link__container-title">Разделы</div>
                    <ul class="footer-menu">
                        @foreach($places as $place)
                            <li><a href="{{route('page-place', [$place['slug']])}}">{{$place['title']}}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-12">
                <div class="footer-info">Информация, размещенная на сайте не является публичной офертой</div>
            </div>
        </div>
    </div>
</footer>

<!-- Yandex.Metrika counter -->
<script>
    (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
        m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
    (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

    ym(79358491, "init", {
        clickmap:true,
        trackLinks:true,
        accurateTrackBounce:true,
        webvisor:true
    });
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/79358491" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->

@yield('scripts')
<script src="{{ asset('js/script.js?260722') }}"></script>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Jost:wght@400;500;600&display=swap" rel="stylesheet">
