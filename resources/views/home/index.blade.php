@extends('layouts.app')

@section('head')

    <title>Личный кабинет пользователя {{$user->displayName()}}</title>

@endsection

@section('content')

@if(isset($message))
    <div id="modal-startup-message" class="modal">
        <div class="modal-dialog">
            <div class="text-center">{{$message}}</div>
        </div>
        <button class="btn btn-primary modal-ok-button">
            <a rel="modal:close">ОК</a>
        </button>
    </div>
@endif

    <div class="container col-md-9">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{$user->displayName()}}</div>

                    <div class="card-body">
                        <form method="POST" action="/home" enctype="multipart/form-data">
                            @csrf



                            <div id="main-form" class="col-md-6 col-sm-12 float-left">
                                <div class="form-group">

                                    <label for="name">Настоящее имя:</label>
                                    <input type="text" name="name" value="{{$user->name}}" class="form-control" required/>
                                    <small class="form-text text-muted">Укажите ваши имя и фамилию, чтобы другие
                                        пользователи смогли узнать, как вас зовут
                                    </small>
                                </div>

                                <div class="form-group">

                                    <label for="name">Никнейм:</label>
                                    <input type="text" name="nick_name" value="{{$user->nick_name}}" class="form-control"/>
                                </div>

                                <div class="form-group">
                                    <label for="specialization">Специализация:</label>
                                    <input type="text" name="specialization" value="{{$user->specialization}}"
                                           class="form-control"/>
                                    <small class="form-text text-muted">Укажите свою специализацию</small>
                                </div>

                                <div class="form-group" style="border: 1px solid black;padding: 1rem;">

                                    <p>Получать email-уведомления:</p>
                                    @if(!$user->emailConfirmed())
                                        <div class="alert alert-danger">Для получения уведомлений необходимо подтвердить свой email. Письмо с кнопкой подтверждения было отправлено на адрес <strong>{{$user->email}}</strong></div>
                                    @endif

                                    <div class="custom-control custom-checkbox my-1 mr-sm-2">
                                        <input type="checkbox" class="custom-control-input" id="article_notifications" name="article_notifications" @if($user->article_notifications) checked @endif/>
                                        <label class="custom-control-label" for="article_notifications">При появлении новых статей</label>
                                    </div>

                                    <div class="custom-control custom-checkbox my-1 mr-sm-2">
                                        <input type="checkbox" class="custom-control-input" id="comment_notifications" name="comment_notifications" @if($user->comment_notifications) checked @endif />
                                        <label class="custom-control-label" for="comment_notifications">При появлении ответов на мои комментарии</label>
                                    </div>

                                </div>

                                <div class="form-group">
                                    <label for="contacts">Контакты:</label>
                                    <input type="text" name="contacts" value="{{$user->contacts}}"
                                           class="form-control"/>
                                    <small class="form-text text-muted">Укажите как с Вами можно связаться. Эта информация будет видна всем на странице Вашего профиля</small>
                                </div>

                                <div class="form-group">
                                    <label for="gender">Пол</label>
                                    <select class="browser-default custom-select" name="gender">
                                        <option {{($user->gender === null) ? 'selected' : ''}} value="">Другой</option>
                                        <option {{($user->gender === false) ? 'selected' : ''}} value="0">Женский
                                        </option>
                                        <option {{($user->gender === true) ? 'selected' : ''}} value="1">Мужской
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="birthdate">Дата рождения</label>
                                    <input class="browser-default custom-select" type="date" name="birthdate"
                                           value="{{$user->birthdate}}"/>
                                </div>
                                <div class="form-group">
                                    <label for="short_info">Краткая информация:</label>
                                    <textarea type="text" name="short_info" rows="5" class="form-control">{{trim($user->short_info)}}</textarea>
                                    <small class="form-text text-muted">Напишите вкратце о себе, эта информация будет выводиться в описании профиля</small>
                                </div>

                                <button type="submit" class="btn btn-primary">Сохранить</button>
                            </div>

                            <div id="avatar-upload" class="col-md-6 col-sm-12 float-left">
                                @include('home.avatar_upload')
                            </div>



                        </form>
                    </div>
                </div>


            </div>


        </div>
    </div>
@endsection
