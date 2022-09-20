@extends('layouts.main')

@section('title', $title)

@section('content')

    <h3>{{ $title }}</h3>

    <ul>
        @foreach($topics as $topic)

            <li>
                <a href="{{ route('message.list', ['id' => $topic->id]) }}">{{ $topic->title }}</a><br>
                @if(auth()->check() && auth()->user()->id === $topic->user_id)
                    <a href="{{ route('topic.edit', ['topic' => $topic->id]) }}">|редактировать|</a>
                    <form action="{{ route('topic.destroy', ['topic' => $topic->id]) }}" method="post">
                        @csrf
                        @method('delete')
                        <input type="submit" value="Удалить">
                    </form>
                @endif
            </li>

        @endforeach

            <p>{{ $topics->links() }}</p>

        <h4>Создать новую тему:</h4>

            @if(auth()->check())

            <form action="{{ route('topic.store') }}" method="post">
                @csrf
                <input name="sectionId" type="hidden" value="{{ $sectionId }}">
                <textarea name="title" id="" cols="30" rows="10" placeholder="Введите текст. Максимум 200 символов"></textarea><br><br>
                <input type="submit">
            </form>

            @else

                <p>Только зарегистрированные пользователи могут создавать темы</p>

            @endif
    </ul>

@endsection
