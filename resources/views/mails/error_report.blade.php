@extends('mails.layout')

@section('content')

    <h1>Сообщение об ошибке</h1>

    <table border="1" cellpadding="10">

        @if(!empty($user))
            <tr>
                <td>Пользователь:</td>
                <td><a href="{{$user->profile_url()}}">{{$user->displayName()}}</a></td>
            </tr>
        @endif

        @if(!empty($selection))
            <tr>
                <td>Выделенный текст</td>
                <td>{{$selection}}</td>
            </tr>
        @endif

        @if(!empty($message))
            <tr>
                <td>Описание</td>
                <td>{{$description}}</td>
            </tr>
        @endif

        <tr>
            <td>Страница</td>
            <td><a href="{{$url}}">{{$url}}</a></td>
        </tr>

    </table>

@endsection
