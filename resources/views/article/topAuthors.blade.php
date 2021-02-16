@extends('layouts.app')

@section('head')

    <title>Лучшие авторы блога Текст-уник</title>

@endsection

@section('content')

    <div class="container article-content">
        <H1 style="color:black;">Авторы «TEXT-уник»</H1>

        <ul class="author-list">
            @foreach($authors as $author)
                <li>
                    @include('home.user_link',['user'=>$author]);
                    <br/>
                </li>
            @endforeach
        </ul>
    </div>
@endsection
