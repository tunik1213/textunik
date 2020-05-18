@extends('mails.layout')

@section('content')

<h1>Здравствуйте, {{$user->displayName()}}</h1>

<p>Спасибо за регистрацию! Подтвердите, пожалуйста, Ваш email-адрес, который Вы указали при регистрации</p>

<a href="{{ route('confirmEmail', ['Id' => $user->id, 'Token' => $user->api_token]) }}" style="background-color: #041e42 !important;
    color: #fff; padding: 10px; cursor: pointer; text-decoration: none; border-radius: 5px; margin: 10px; display:inline-block;">Подтвердить регистрацию</a>

@endsection
