@extends('layouts.app')

@section('js')
    <script src="{{ asset('js/my-page.js') }}" defer></script>
@endsection

@section('content')

    <div class="container border-flame w-9 py-sm-5 py-3 my-5">
        <h2 class="text-center mb-3">勉強記録</h3>
        <table class="table">
            <thead class="main-bg-color">
                <tr>
                <th scope="col text-center">日付</th>
                <th scope="col">勉強時間</th>
                <th scope="col">勉強内容</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($records as $record)
                    <tr>
                        <th scope="row">
                            <div class="date">{{ $record->updated_at->format("Y/m/d") }}</div>
                            <div class="time">{{ $record->updated_at->format("H:i") }}</div>
                        </th>
                        <td>{{ $record->total_minutes }}分</td>
                        <td>{{ $record->learning_content }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @if(empty($email))
        <div id="create-account-form" class="container border-flame w-9 py-sm-5 py-3 my-5">
            <h3 class="text-center mb-3">新規会員登録</h3>
            <p class="text-center">
                会員登録をしていただくと、 勉強した時間の記録を残すことができます。
            </p>

            <div class="card-body">
                <div id="error-message"></div>
                <form method="POST" action="{{ route('user.store') }}">
                                @csrf

                                <div class="row mb-3">
                                    <label for="name" class="required col-md-4 col-form-label text-md-end">{{ __('ユーザー名(最大10文字)') }}</label>

                                    <div class="col-md-6">
                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="山田花子(最大10文字)">

                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="email" class="required col-md-4 col-form-label text-md-end">{{ __('Eメールアドレス') }}</label>

                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="example@mail.com">

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="password" class="required col-md-4 col-form-label text-md-end">{{ __('パスワード(英数字12文字以上)') }}</label>

                                    <div class="col-md-6">
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" value="{{ old('password') }}" placeholder="パスワード(英数字12文字以上)">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="password-confirm" class="required col-md-4 col-form-label text-md-end">{{ __('もう一度パスワードを入力') }}</label>

                                    <div class="col-md-6">
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" value="{{ old('password_confirmation') }}" placeholder="確認パスワード(英数字12文字以上)">
                                    </div>
                                </div>

                                <div class="row mb-0">
                                    <div class="text-center">
                                        <button id="store-btn" type="button" class="btn btn-primary px-5 py-2 mt-3 mb-5">
                                            {{ __('登録') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
            </div>
        </div>
    @else
        <div id="change-forme" class="container border-flame w-9 py-sm-5 py-3 my-5">
            <h3 class="text-center mb-3">ユーザー情報変更</h3>
            <p class="text-center">
                登録したユーザ名やメールアドレスをパスワード変更したい場合はこちらより変更してください。
            </p>

            <div class="card-body">
                <div id="error-message"></div>
                <form method="POST" action="{{ route('user.name-change') }}">
                    @csrf
                    <div class="row mb-3">
                        <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('ユーザー名') }}</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ Auth::user() ->name }}" required autocomplete="name" autofocus>

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-0">
                        <div class="text-center">
                            <button id="name-change-btn" type="button" class="btn btn-primary px-5 py-2 mb-5">
                                    {{ __('変更') }}
                            </button>
                        </div>
                    </div>
                </form>
                <form method="POST" action="{{ route('user.email-change') }}">
                    @csrf
                    <div class="row mb-3">
                        <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Eメールアドレス') }}</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ Auth::user()->email }}" required autocomplete="email">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-0">
                        <div class="text-center">
                            <button id="email-change-btn" type="button" class="btn btn-primary px-5 py-2 mb-5">
                                    {{ __('変更') }}
                            </button>
                        </div>
                    </div>
                </form>
                <form method="POST" action="{{ route('user.password-change') }}">
                    @csrf
                    <div class="row mb-3">
                        <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('パスワード') }}</label>

                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" value="{{ old('password') }}">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('もう一度パスワードを入力') }}</label>

                        <div class="col-md-6">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" value="{{ old('password_confirmation') }}">
                        </div>
                    </div>

                    <div class="row mb-0">
                        <div class="text-center">
                            <button id="password-change-btn" type="button" class="btn btn-primary px-5 py-2 mb-5">
                                    {{ __('変更') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endif
@endsection
