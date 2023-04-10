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
