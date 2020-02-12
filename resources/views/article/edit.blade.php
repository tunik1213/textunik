@php($user=\Illuminate\Support\Facades\Auth::user())

@extends('layouts.app')

@section('head')

    <title>{{$pageTitle}}</title>

    <meta name="article-id" content="{{$article->id}}"/>

    <script src="{{asset('js/lib/tinymce.js')}}" referrerpolicy="origin"></script>
@endsection

@section('content')

    {{--    <script src="{{ asset('js/lib/trumbowyg.js') }}"></script>--}}
    {{--    <script src="{{ asset('js/lib/trumbowyg.upload.js') }}"></script>--}}
    {{--    <script src="{{ asset('js/lib/lang/trumbowyg-ru.js') }}"></script>--}}
    {{--    <link rel="stylesheet" href="{{ asset('js/lib/ui/trumbowyg.css') }}">--}}

    <div class="container col-md-9">

        <h1>{{$pageTitle}}</h1>

        <form method="POST" action="{{route('article.post', ['id'=>$article->id])}}" id="article-editor-form">
            @csrf

            <div class="form-group">
                <label for="title">Заголовок:</label>
                <input type="text" name="title" value="{{$article->title}}" class="form-control" AUTOCOMPLETE="off"
                       required/>
                <small class="form-text text-muted">Заголовок должен быть наполнен смыслом, чтобы можно было понять, о
                    чем будет публикация.
                </small>
            </div>

            @if($user->moderator)

                <div class="form-group">
                    <label for="title">Keywords:</label>
                    <input type="text" name="keywords" value="{{$article->meta_keywords}}" class="form-control"
                           AUTOCOMPLETE="off" required/>
                </div>

                <div class="form-group">
                    <label for="title">Description:</label>
                    <input type="text" name="description" value="{{$article->meta_description}}" class="form-control"
                           AUTOCOMPLETE="off" required/>
                </div>


            @endif

            <div class="form-group">
                <label for="annotation">Текст до ката</label>
                <textarea class="htmleditor" name="annotation"></textarea>
            </div>

            <div id="cut">
                <img src="/images/Scissors-128.png" width="20" height="20"/>
                <div id="dashed-border"></div>
                <br>
            </div>

            <div class="form-group">
                <label for="content">Текст после ката</label>
                <textarea class="htmleditor" name="article-content"></textarea>
            </div>

            <button type="submit" name="finished" value="1" class="btn btn-primary">Опубликовать</button>
            @if(!$article->public())
                <button type="submit" name="finished" value="0" name="save-draft" class="btn btn-secondary">Сохранить в
                    черновики
                </button>
            @endif
            <button type="button" id="btn-preview" class="btn float-right" data-toggle="modal"
                    data-target="#preview-content">Предпросмотр
            </button>

        </form>

    </div>

    <div class="modal fade" id="preview-content" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content article-content">
                <div class="modal-header">
                    <h2 class="modal-title" id="exampleModalLongTitle">Предпросмотр</h2>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body article-text">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Закрыть</button>
                </div>
            </div>
        </div>
    </div>


    <script>
        var submit = false;

        $(document).ready(function () {

            function fillEditorContent(e) {
                if ($(this).attr('id') == 'article-content')
                    this.setContent(`{!! $article->content !!}`);

                if ($(this).attr('id') == 'annotation')
                    this.setContent(`{!! $article->annotation !!}`);
            }

            tinymce.init({
                selector: '.htmleditor',
                language: 'ru',
                language_url: '{{asset('js/lib/lang/tinymce-ru.js')}}',
                plugins: "image, link, fullscreen, emoticons, media, lists",
                toolbar: 'undo redo | styleselect | bold italic removeformat | alignleft aligncenter alignright alignjustify | bullist numlist | indent outdent | emoticons link image media | fullscreen',
                menubar: false,
                height: 300,
                media_live_embeds: true,
                file_picker_types: 'file image media',
                images_upload_url: '/upload',
                automatic_uploads: true,
                images_upload_handler: uploadImage,
                setup: function(editor) {
                    editor.on('init', fillEditorContent);
                },
                content_style: 'h1,h2,h3,h4,h5,h6{color:#C45911;}'
            });



            $('#btn-preview').click(function (e) {
                e.preventDefault();
                tinyMCE.triggerSave();
                $('.modal-title').html('Предпросмотр: ' + $('[name="title"]').val());
                $('.modal-body').html(
                    $('[name="annotation"]').val()
                    + '<br />' +
                    $('[name="article-content"]').val()
                );
            });

            // блокируем Tab т.к. пользователь нечаянно нажимает опубликовать статью, пока набирает
            $(document).keydown(function (e) {
                if (e.keyCode == 9) {
                    e.preventDefault();
                }
            });

            @if ($article->authorId == \Illuminate\Support\Facades\Auth::user()->id)
            // каждую минуту сохраняем данные формы на всякий случай
            window.setInterval(ajax_save, 60000);
            @endif

        });

        $('button[type=submit]').on('click', function () {
            submit = true;
        });

        @if(!(env('APP_DEBUG')))
        $(window).on('beforeunload', function () {
            if (!submit) return confirm();
        });

        @endif

        function ajax_save() {
            tinyMCE.triggerSave();
            var form = $('#article-editor-form');
            $.ajax({
                type: 'POST',
                url: form.attr('action'),
                data: form.serialize(),
                async: true,
            });
        }

        function uploadImage(blobInfo, success, failure) {
            var xhr, formData;

            xhr = new XMLHttpRequest();
            xhr.withCredentials = false;
            xhr.open('POST', '/upload');

            xhr.onload = function() {
                var json;

                if (xhr.status != 200) {
                    failure('HTTP Error: ' + xhr.status);
                    return;
                }

                json = JSON.parse(xhr.responseText);

                if (!json || typeof json.url != 'string') {
                    failure('Invalid JSON: ' + xhr.responseText);
                    return;
                }

                success(json.url);
            };

            formData = new FormData();
            formData.append('filename', blobInfo.blob(), blobInfo.filename());
            formData.append('_token','{{ csrf_token() }}');

            xhr.send(formData);
        }

    </script>

    <style>
        #dashed-border {
            border-bottom: 1px black dashed;
            margin-top: -10px;
            margin-left: 15px;
        }

        .modal {
            width: 90%;
            z-index: 9999;
            margin-left: 5%;
            max-width: initial;
        }

        .modal-dialog {
            max-width: 90%;
        }

        .tox-notifications-container, .tox-statusbar {
            display: none !important;
        }
    </style>

@endsection
