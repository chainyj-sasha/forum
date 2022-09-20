@extends('layouts.main')

@section('title', $title)

@section('content')

    <h3>Профиль юзера {{ $user->name }}</h3>

    <p>Имя: {{ $user->name }}</p>
    <p>Логин: {{ $user->email }}</p>
    <p>
        @if($user->active)
            Активность: Активен
        @else
            Активность: Забанен
        @endif
    </p>
    <p>
        @if($user->admin)
            Статус: Модератор
        @else
            Статус: Юзер
        @endif
    </p>

@endsection
