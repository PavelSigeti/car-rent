@extends('layouts.dashboard')

@section('title', 'Настройки')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">@if($errors->any())
                    <ul class="errors-container">
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                @endif
            </div>
            <div class="col-12">
                <h1>Настройки</h1>

                <form action="{{route('setting.update')}}" method="post" class="form-admin">
                    @csrf
                    @method('PATCH')
                    @foreach($settings as $setting)
                        <p>{{$setting->title}}</p>
                        <input name="{{$setting->name}}" type="text" value="{{$setting->value}}">
                        <br>
                    @endforeach
                    <br>
                    <button>Сохранить</button>
                </form>
            </div>
        </div>
    </div>

@endsection
