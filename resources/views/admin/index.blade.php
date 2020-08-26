@extends('layouts.app')

@section('head')

    <title>Админка</title>

@endsection

@section('content')
    <div class="container col-md-9 padding-0-phone">
        <h1>Админка</h1>

        <a href="/admin/users">Пользователи</a>
        <br/>

        <a href="/admin/articles">Статьи</a>
        <br/>

        <a href="/admin/tags">Теги</a>
        <br/>


    </div>
@endsection
