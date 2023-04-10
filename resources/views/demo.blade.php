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

    <h1>Welcome</h1>

@endsection
