@extends('layouts.dashboard')

@section('title', 'Записи')

@section('content')

        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h1>Записи</h1>
                </div>
                <div class="col-12">
                    <a href="{{route('post.create')}}" class="add-new-btn">Добавить запись</a>
                </div>
                <div class="col-12">
                    <ul class="ul-admin">
                        @foreach($posts as $post)
                            <li><a href="{{route('post.edit', [$post->id])}}">{{$post->title}}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>


@endsection
