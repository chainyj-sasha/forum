@extends('layouts.main')

@section('title', $title)

@section('content')

    <h3>Доступные разделы:</h3>

    <ul>
        @foreach($sections as $section)

            <li><a href="{{ route('topic.list', ['id' => $section->id]) }}">{{ $section->title }}</a></li>

        @endforeach
    </ul>

    @if(auth()->check() && auth()->user()->admin)

        <h3>Добавление нового раздела</h3>

        <form action="{{ route('admin.user.store') }}" method="post">
            @csrf
            <textarea name="title" id="" cols="30" rows="10" placeholder="Максимум 200 символов"></textarea><br><br>
            <input type="submit">
        </form>

    @endif

@endsection
