@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{$user->nick_name}}</div>

                    <div class="card-body">
                        <form method="POST" action="/home" enctype="multipart/form-data">
                            @csrf



                            <div id="main-form" class="col-md-6 col-sm-12 float-left">
                                <div class="form-group">

                                    <label for="name">Настоящее имя:</label>
                                    <input type="text" name="name" value="{{$user->name}}" class="form-control"/>
                                    <small class="form-text text-muted">Укажите ваши имя и фамилию, чтобы другие
                                        пользователи смогли узнать, как вас зовут
                                    </small>
                                </div>
                                <div class="form-group">
                                    <label for="specialization">Специализация:</label>
                                    <input type="text" name="specialization" value="{{$user->specialization}}"
                                           class="form-control"/>
                                    <small class="form-text text-muted">Укажите свою специализацию</small>
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
                            </div>

                            <div id="avatar-upload" class="col-md-6 col-sm-12 float-left">
                                @include('home.avatar_upload')
                            </div>

                            <button type="submit" class="btn btn-primary">Сохранить</button>

                        </form>
                    </div>
                </div>


            </div>


        </div>
    </div>
@endsection
