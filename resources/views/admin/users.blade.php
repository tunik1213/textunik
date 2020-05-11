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
    <td>Дата регистрации</td>
    <td>Email регистрации</td>
    <td>Дата рождения</td>
    <td>Пол</td></tr>
    </thead>
    @foreach ($users as $user)

    <tr>
        <td>@include('home.user_link',['user'=>$user]);</td>
        <td>{{$user->created_at}}</td>
        <td>{{$user->email}}</td>
        <td>{{$user->birthdate}}</td>
        <td>{{$user->gender_str()}}</td>
    </tr>    
    
    @endforeach
    </table>

    </div>

@endsection
