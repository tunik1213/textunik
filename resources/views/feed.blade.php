@extends('layouts.app')
@section('head')

    <title>ТекСТиль - все о работе копирайтера</title>

@endsection

@section('content')
    <div class="container">

        @foreach ($articles as $article)

            <div class="container">
                @include('article.annotation')
                <br/>

                <a href="{{$article->url()}}#cut">Читать дальше →</a>

            </div>

            <br>
        @endforeach

        {{ $articles->links() }}

    </div>
@endsection