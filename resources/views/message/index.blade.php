@extends('layouts.main')

@section('title', $title)

@section('content')

    <h3>{{ $title }}</h3>

    <ul>
        @foreach($messages as $message)

            <li>
                <a href="{{ route('user.show', ['user' => $message->user->id]) }}">{{ $message->user->name }}</a>. {{ $message->text }}. Дата сообщения: {{ $message->created_at }}<br>
                @if(auth()->check() && auth()->user()->id === $message->user_id)
                    <a href="{{ route('message.edit', ['message' => $message->id]) }}">редактировать</a>
                @endif
                @if((auth()->check() && auth()->user()->id === $message->user_id) || (auth()->check() && auth()->user()->admin))
                    <form action="{{ route('message.destroy', ['message' => $message->id]) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <input type="submit" value="Удалить">
                    </form>
                @endif

            </li>

            @endforeach

                <p>{{ $messages->links() }}</p>

        </ul>

        <h4>Введите новое сообщение</h4>

        @if(auth()->check())

        <form action="{{ route('message.store') }}" method="post">
            @csrf
            <input name="topicId" type="hidden" value="{{ $topicId }}">
            <textarea name="text" id="" cols="30" rows="10" placeholder="Введите текст сообщения"></textarea><br><br>
            <input type="submit">
        </form>

        @else
            <p>Только зарегистрированные пользователи могут оставлять сообщения</p>
        @endif

    @endsection
