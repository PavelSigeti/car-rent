@extends('layouts.dashboard')

@section('title', 'Контроль панель')

@section('content')

    @if($errors->any())
        <ul class="errors-container">
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    @endif
    <section class="section-item">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <a href="{{route('place.create')}}" class="add-new-btn">Добавить новую точку</a>
                </div>
                <div class="col-12">
                    <ul class="ul-admin">
                        @foreach($places as $place)
                            <li><a href="{{route('place.edit', [$place['id']])}}">{{$place->name}}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </section>


@endsection
