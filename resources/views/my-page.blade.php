@extends('layouts.app')

@section('title')
| マイページ・学習記録一覧 | オンライン自習室
@endsection

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

            <div class="card-body col-md-5 m-auto">
                <div id="error-message"></div>
                <form method="POST" action="{{ route('user.store') }}">
                                @csrf

                                <div class="mb-4">
                                    <label for="name" class="required col-form-label">
                                        {{ __('ユーザー名') }}
                                        <span class="rule">(最大10文字)</span>
                                    </label>

                                    <div class="">
                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="山田花子(最大10文字)">

                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label for="email" class="required col-form-label">{{ __('Eメールアドレス') }}</label>

                                    <div class="">
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="example@mail.com">

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label for="password" class="required col-form-label">
                                        {{ __('パスワード') }}
                                        <span class="rule">(英数字8文字以上)</span>
                                    </label>

                                    <div class="">
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" value="{{ old('password') }}" placeholder="パスワード(英数字8文字以上)">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label for="password-confirm" class="required col-form-label">
                                        {{ __('パスワード再入力') }}
                                        <span class="rule">(英数字8文字以上)</span>
                                    </label>

                                    <div class="">
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" value="{{ old('password_confirmation') }}" placeholder="確認パスワード(英数字8文字以上)">
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
        <div id="registration-completed" class="container border-flame w-9 py-sm-5 py-5 my-5">
            <div class="wrap">
                <h3 class="mb-4 text-center">仮登録が完了しました</h3>
                <p class="mb-2">入力いただいたメールアドレスへ仮登録確認のメールをお送りしました。</p>
                <p class="mb-5">メール内にある確認リンクを押して、会員登録を完了してください。</p>
                <p class="mb-5">メールが届いていない方は、<a href="#">こちら</a>より運営へお問い合わせください。</p>
                <p class="fz-7">※ ご登録いただいた情報の変更はヘッダーメニューのマイページより変更いただけます。</p>
            </div>
        </div>
    @else
        <div id="change-forme" class="container border-flame w-9 py-sm-5 py-3 my-5">
            <h3 class="text-center mb-3">ユーザー情報変更</h3>
            <p class="text-center">
                登録したユーザ名やメールアドレスをパスワード変更したい場合はこちらより変更してください。
            </p>

            <div class="card-body col-md-5 m-auto">
                <div id="error-message"></div>
                <form method="POST" action="{{ route('user.name-change') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="col-form-label">
                            {{ __('ユーザー名') }}
                            <span class="rule">(最大10文字)</span>
                        </label>

                        <div class="">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ Auth::user() ->name }}" required autocomplete="name" autofocus>

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-0">
                        <div class="text-end">
                            <button id="name-change-btn" type="button" class="btn btn-primary px-5 py-2 mb-5">
                                    {{ __('変更') }}
                            </button>
                        </div>
                    </div>
                </form>
                <form method="POST" action="{{ route('user.email-change') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="col-form-label">{{ __('Eメールアドレス') }}</label>

                        <div class="">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ Auth::user()->email }}" required autocomplete="email">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-0">
                        <div class="text-end">
                            <button id="email-change-btn" type="button" class="btn btn-primary px-5 py-2 mb-5">
                                    {{ __('変更') }}
                            </button>
                        </div>
                    </div>
                </form>
                <form method="POST" action="{{ route('user.password-change') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="password" class="col-form-label">
                            {{ __('パスワード') }}
                            <span class="rule">(英数字8文字以上)</span>
                        </label>

                        <div class="">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" value="{{ old('password') }}">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="password-confirm" class="col-form-label">
                            {{ __('パスワード再入力') }}
                            <span class="rule">(英数字8文字以上)</span>
                        </label>

                        <div class="">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" value="{{ old('password_confirmation') }}">
                        </div>
                    </div>

                    <div class="row mb-0">
                        <div class="text-end">
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
