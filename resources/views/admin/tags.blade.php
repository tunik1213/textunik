@extends('layouts.app')

@section('head')

    <title>Список тегов для статей</title>

@endsection

@section('content')

    <div class="container col-md-9 padding-0-phone">

        <a href="/admin">&#8612; Назад в админку</a>

        <br /><br />

        <a href="{{ route('tags.create') }}" class="btn btn-primary">Создать</a>

        <br />

        <table cellspacing="5" cellpadding="10" border="1" width="100%">
            <thead><tr>
                <td width="10%">№</td>
                <td width="40%">Название</td>
                <td width="40%">URL</td>
                <td width="10%">Действие</td>
            </tr>
            </thead>
            @foreach ($tags as $tag)

                <tr>
                    <td>{{$tag->id}}</td>
                    <td>{{$tag->name}}</td>
                    <td>{{$tag->slug}}</td>
                    <td>
                        <a href="{{ route('tags.edit',[$tag->id]) }}">Изменить</a>
                        <form action="{{ route('tags.destroy',[$tag->id]) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="remove" data-confirm="Удалить тег {{$tag->name}}?"> Удалить </button>
                        </form>
                    </td>
                </tr>

            @endforeach
        </table>

    </div>

@endsection
