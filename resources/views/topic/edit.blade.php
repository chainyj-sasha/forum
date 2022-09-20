@extends('layouts.main')

@section('title', $title)

@section('content')

    <h3>{{ $title }}</h3>

    <form action="{{ route('topic.update', ['topic' => $topic->id]) }}" method="post">
        @csrf
        @method('PUT')
        <textarea name="title" id="" cols="30" rows="10">{{ $topic->title }}</textarea><br><br>
        <input type="submit" value="Сохранить">
    </form>

@endsection
