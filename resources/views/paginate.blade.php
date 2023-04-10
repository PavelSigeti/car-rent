@foreach($cars as $key => $car)
    <div class="col-xl-4 col-md-6" itemscope itemprop="itemListElement" itemtype="http://schema.org/Product">
        <a href="{{route('user.car.show', [$car->slug])}}@if($requestPlace > 0)?place={{$requestPlace}}@endif" itemprop="url">
            <div class="car-item">
                <div class="car-image">
                    <picture>
                        @isset($images[$key][0]->uri)
                            <source srcset="{{$images[$key][1]->uri}}" type="image/webp">
                            <img itemprop="image" src="{{$images[$key][0]->uri}}" alt="{{$car->name}}">
                        @else
                            <img src="/storage/orders/demo.jpg" alt="">
                        @endisset
                    </picture>
                    <meta itemprop="description" content="автомобиль {{$car->name}}">
                </div>
                <div class="car-content">
                    <span class="car-name" itemprop="name">{{$car['name']}}</span>
                    <div class="car-meta">
                        @foreach($car->metas as $meta)
                            @if($meta->type == 'transmission' || $meta->type == 'body')<span class="car-meta__item">{{$meta->name}}</span> @endif
                        @endforeach
                        <span class="car-meta__item">{{$car->seats}} мест</span>
                    </div>
                    <div class="car-content__bottom" itemscope itemprop="offers" itemtype="http://schema.org/Offer">
                        <span class="car-price"><span itemprop="price">{{$car->price}}</span>руб.</span>
                        <div class="car-content__btn">Забронировать</div>
                        <meta itemprop="priceCurrency" content="RUB">
                        <meta itemprop="availability" content="http://schema.org/InStock" />
                    </div>
                </div>

            </div>
        </a>
    </div>
@endforeach
@if($nextPage <= $pages)
    <div class="col-12 col-center delete-after-fetch">
        <div class="blue-button" id="show-more" data-page="{{$nextPage}}">Показать еще</div>
    </div>
@endif
