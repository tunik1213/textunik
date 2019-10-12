@extends('layouts.app')

@section('head')

    <title>Добавление новой публикации</title>

@endsection

@section('content')

    <script src="{{ asset('js/lib/trumbowyg.js') }}"></script>
    <script src="{{ asset('js/lib/trumbowyg.upload.js') }}"></script>
    <script src="{{ asset('js/lib/lang/trumbowyg-ru.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('js/lib/ui/trumbowyg.css') }}">


    <div class="container">

        <h1>Добавление новой публикации</h1>

        <form method="POST" action="/article/add/">
            @csrf

            <div class="form-group">

                <label for="title">Заголовок:</label>
                <input type="text" name="title" value="" class="form-control" AUTOCOMPLETE="off"/>
                <small class="form-text text-muted">Заголовок должен быть наполнен смыслом, чтобы можно было понять, о чем будет публикация.</small>
            </div>

            <div class="form-group">
                <label for="annotation">Текст до ката</label>
                <div class="htmleditor" id="annotation"></div>
            </div>

            <div id="cut">
                <img src="/images/Scissors-128.png" width="20" height="20"/>
                <div id="dashed-border"></div>
                <br>
            </div>

            <div class="form-group">
                <label for="content">Текст после ката</label>
                <div class="htmleditor" id="content"></div>
            </div>

            <button type="submit" class="btn btn-primary">Опубликовать</button>

        </form>

    </div>


    <script>
        $( document ).ready(function() {
            $('.htmleditor').trumbowyg({
                lang: 'ru',
                btns: [
                    ['undo', 'redo'], // Only supported in Blink browsers
                    ['formatting'],
                    ['strong', 'em', 'del'],
                    ['superscript', 'subscript'],
                    ['link'],
                    ['upload'],
                    ['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull'],
                    ['unorderedList', 'orderedList'],
                    ['horizontalRule'],
                    ['removeformat'],
                    ['fullscreen'],

                ],
                plugins: {
                    upload: {
                        serverPath: '/upload',
                        data:[{name: '_token', value: '{{ csrf_token() }}'}],
                        fileFieldName: 'filename',
                        urlPropertyName: 'url',
                        imageWidthModalEdit: true
                    }
                }
            });
        });

    </script>

    <style>
        #dashed-border{
            border-bottom: 1px black dashed;
            margin-top: -10px;
            margin-left: 15px;
        }
    </style>

@endsection