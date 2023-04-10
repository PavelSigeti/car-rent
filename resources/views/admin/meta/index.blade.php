@extends('layouts.dashboard')

@section('title', 'Фильтры автомобилей')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h1>Фильтры автомобилей</h1>
            </div>
            <div class="col-12">
                @if($errors->any())
                    <ul class="errors-container">
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                @endif
            </div>
            <div class="col-12">
                <div class="admin-cat__container">
                    @foreach($metasType as $meta)
                        <a href="{{route('meta.type', [$meta->type])}}" class="admin-cat__item">{{$meta->type}}</a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>



@endsection
