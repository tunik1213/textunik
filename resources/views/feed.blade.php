@extends('layouts.app')
@section('head')

    <title>ТекСТиль - все о работе копирайтера</title>

@endsection

@section('content')
    @include('article.list',['articles'=>$articles])
@endsection