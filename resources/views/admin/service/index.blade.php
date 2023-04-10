@extends('layouts.dashboard')

@section('title', 'Фильтры автомобилей')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h1>Услуги</h1>
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
                <form action="{{route('service.store')}}" method="post" class="form-admin">
                    @csrf
                    <p>Название новой услуги</p>
                    <input type="text" name="name" placeholder="Название новой услуги" value="{{old('name')}}">
                    <p>Цена</p>
                    <input type="number" name="price">
                    <br>
                    <br>
                    <button>Создать</button>
                </form>
            </div>
            <div class="col-12">
                <ul class="ul-admin">
                    @foreach($services as $service)
                        <li>
                            <form action="{{route('service.destroy', [$service->id])}}" method="post">
                                <div class="meta-item">
                                    @csrf
                                    @method('DELETE')
                                    {{$service->name}} - {{$service->price}}
                                    <button>Удалить</button>
                                </div>
                            </form>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>



@endsection
