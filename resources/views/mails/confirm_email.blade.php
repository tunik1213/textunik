@extends('mails.layout')

@section('content')

<h1>Здравствуйте, {{$user->displayName()}}</h1>

<p>Спасибо за регистрацию! Подтвердите, пожалуйста, Ваш email-адрес, который Вы указали при регистрации</p>

<a href="{{ route('confirmEmail', ['id' => $user->id, 'token' => $user->api_token]) }}" class="email-action-button">Подтвердить регистрацию</a>

@endsection
