@extends('layouts.dashboard')

@section('title', 'Консоль')

@section('content')
    <section class="section-item">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="admin-cat__container">
                        <a href="{{route('car.index')}}" class="admin-cat__item">Автомобили</a>
                        <a href="{{route('meta.index')}}" class="admin-cat__item">Фильтры автомобилей</a>
                        <a href="{{route('service.index')}}" class="admin-cat__item">Доп. услуги</a>
                        <a href="{{route('place.index')}}" class="admin-cat__item">Точки доставки</a>
                        <a href="{{route('page.index')}}" class="admin-cat__item">Страницы</a>
                        <a href="{{route('post.index')}}" class="admin-cat__item">Записи</a>
                        <a href="{{route('order.index')}}" class="admin-cat__item">Заказы</a>
                        <a href="{{route('setting.index')}}" class="admin-cat__item">Настройки</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
