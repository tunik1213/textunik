@extends('layouts.app')

@section('head')

    <title>Список тегов для статей</title>

@endsection

@section('content')

    <div class="container col-md-9 padding-0-phone">

        <a href={{ route('tags.index',[$tag->id]) }}>&#8612; Назад к списку тегов</a>

        <br /><br />

        <form action="{{ route('tags.store',[$tag->id]) }}" method="POST">
            @csrf

            <input type="hidden" name="id" value="{{$tag->id}}" />

            <label for="name">Имя:</label>
            <input type="text" name="name" value="{{$tag->name}}" autofocus/>

            <input type="submit" value="сохранить" />

        </form>

    </div>

@endsection
