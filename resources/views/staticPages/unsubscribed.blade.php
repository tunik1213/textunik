@extends('layouts.app')

@section('head')

    <title>Рассылка отключена</title>
    <meta name="robots" content="noindex">

@endsection

@section('content')
    <div class="container col-md-8">
        <h1>Вы успешно отписались от рассылки</h1>
        
        <br />

        <p>Включать и выключать различные email-уведомления Вы можете в <a href="{{ route('home') }}">личном кабинете</a></p>

        <br />

        <a href="/">← На главную</a>

    </div>
@endsection
