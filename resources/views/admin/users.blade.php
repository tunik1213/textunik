@extends('layouts.app')

@section('head')

    <title>Список пользователей</title>

@endsection

@section('content')

    <div class="container col-md-9 padding-0-phone">

    <a href="/admin">&#8612; Назад в админку</a>

    <br />

    <table cellspacing="5" cellpadding="10" border="1" width="100%">
    <thead><tr>
    <td>Профиль</td>
        <td>Имя</td>
    <td>Дата регистрации</td>
    <td>Email</td>
        <td>Еmail подтв.</td>
    <td>Дата рождения</td>
    <td>Пол</td>
    <td>Подписка на статьи</td>
    <td>Подписка на комменты</td>
    </tr>
    </thead>
    @foreach ($users as $user)

    <tr>
        <td>@include('home.user_link',['user'=>$user]);</td>
        <td>{{$user->name}}</td>
        <td>{{$user->created_at}}</td>
        <td>{{$user->email}}</td>
        <td>{{view_bool($user->emailConfirmed())}}</td>
        <td>{{$user->birthdate}}</td>
        <td>{{$user->gender_str()}}</td>
        <td>{{view_bool($user->article_notifications)}}</td>
        <td>{{view_bool($user->comment_notifications)}}</td>
    </tr>

    @endforeach
    </table>

    </div>

@endsection
