<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
</head>
<body>

@if(session('error'))
    {{ session('error') }}
@endif
@if(session('success'))
    {{ session('success') }}
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if(auth()->check())
    Вы вошли как <a href="">{{ auth()->user()->name }}</a>
    <p><a href="{{ route('user.logout') }}">Разлогин</a></p>

    @if(auth()->check() && auth()->user()->admin)
        <p>Вы модератор сайта</p>
        <a href="{{ route('admin.user.showAll') }}">Список юзеров</a>
    @endif

@else

    <p>Вы не авторизованы</p>

    <form action="{{ route('user.login') }}" method="post">
        @csrf
        <input name="email" type="text"> Логин<br><br>
        <input name="password" type="password"> Пароль<br><br>
        <input name="" type="submit">
    </form>

    <p><a href="{{ route('user.create') }}">Регистрация на сайте</a></p>

@endif


<h1>Форум на любую тематику</h1>

@yield('content')

@if($_SERVER['REQUEST_URI'] != '/section')
    <p>
        <button><a href="{{ route('section.index') }}">На главную</a></button>
    </p>
@endif

</body>
</html>
