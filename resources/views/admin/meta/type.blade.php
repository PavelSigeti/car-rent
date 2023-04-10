@extends('layouts.dashboard')

@section('title', 'Фильтры автомобилей')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h1>{{$metas->first()->title}}</h1>
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
                <form action="{{route('meta.store')}}" method="post" class="form-admin">
                    @csrf
                    <input type="hidden" name="type" value="{{$type}}">
                    <input type="text" name="name" placeholder="Название нового элемента">
                    <br>
                    <button>Создать</button>
                </form>
            </div>
            <div class="col-12">
                <ul class="ul-admin">
                    @foreach($metas as $meta)
                        <li>
                            <a href="{{route('meta.edit', [$meta->id])}}">{{$meta->name}}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

@endsection
