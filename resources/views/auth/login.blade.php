@extends('layouts.app')

@section('head')

    <title>Вход на сайт</title>
    <meta name="robots" content="noindex">

@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
    @include('auth.login_form')
            </div>
        </div>
    </div>
@endsection
