
            <div class="card">
                <div class="card-header">
                    <h1>Присоединяйтесь!</h1>
                    <span>Войдите чтобы иметь возможность писать посты и комментарии</span>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">E-mail</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Пароль</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-9 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Войти
                                </button>

                                {{--                                TODO восстановление пароля--}}
                                {{--                                <a class="btn btn-link" href="{{ route('password.request') }}">--}}
                                {{--                                    Забыли пароль?--}}
                                {{--                                </a>--}}
                            </div>
                        </div>
                    </form>
<br/>
                    <div class="container">
                        <p>Еще нет аккаунта? <a href="{{ route('register') }}">Зарегистрируйтесь</a></p>
                    </div>
                    <div class="container">
                        @include('auth.social')
                    </div>
                </div>
            </div>
