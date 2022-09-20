@extends('layouts.main')

@section('title', $title)

@section('content')

    <h3>{{ $title }}</h3>

    <form action="{{ route('message.update', ['message' => $message->id]) }}" method="post">
        @csrf
        @method('PUT')
        <textarea name="text" id="" cols="30" rows="10">{{ $message->text }}</textarea><br><br>
        <input type="submit" value="Сохранить">
    </form>

@endsection
