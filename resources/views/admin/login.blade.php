<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <meta name="robots" content="noindex" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="shortcut icon" href="{{ asset('img/svg/ico-admin.svg') }}">


    <link  href="{{ asset('libs/date/hotel-datepicker.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('styles/admin.css?08022022') }}">
    <link rel="stylesheet" href="{{ asset('styles/admin-media.css?08022022') }}">

    <title>Вход</title>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-12 login-center">
            <form action="{{route('login')}}" method="post" class="form-admin form-login">
                    @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="errors-container">
                            @foreach($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                @csrf
                <p>Логин</p>
                <input type="text" name="login" placeholder="Логин">
                <p>Пароль</p>
                <input type="password" name="password" placeholder="Пароль">
                <div class="remember-checkbox">
                    <input type="checkbox" name="remember" id="remember">
                    <label for="remember">Запомнить устройство</label>
                </div>
                <button>Войти</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>
