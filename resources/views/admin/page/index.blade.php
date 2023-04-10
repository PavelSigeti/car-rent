@extends('layouts.dashboard')

@section('title', 'Записи')

@section('content')

        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h1>Страницы</h1>
                </div>
                <div class="col-12">
                    <a href="{{route('page.create')}}" class="add-new-btn">Добавить страницу</a>
                </div>
                <div class="col-12">
                    <ul class="ul-admin">
                        @foreach($pages as $page)
                            <li><a href="{{route('page.edit', [$page->id])}}">{{$page->title}}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>


@endsection
