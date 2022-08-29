@extends('layouts.app')

@section('js')
    <script src="{{ asset('js/exit.js') }}" defer></script>
@endsection

@section('content')
        <div class="container border-flame w-9 py-sm-5 py-3 my-5 panel-bg">
            <h2 class="fs-4 text-center mb-3">勉強お疲れ様でした。</h2>
            <div class="border-flame w-sm-50 m-auto bg-white exit-board">
                <dl class="total-time text-center mt-3">
                    <dt>総勉強時間</dt>
                    <dd>{{ $user->total_minutes }}分</dd>
                </dl>
                <h3 class="text-center fs-4">勉強内容</h3>
                <div class="m-auto w-25 text-center mb-5">
                    <p class="m-0">{{ $user->learning_content }}</p>
                </div>
            </div>
            <p class="text-center mt-4">勉強した記録にツイートしてみませんか？</p>
            <a href="＃" alt="Twitterに投稿" type="button" class="btn join-btn my-3">Twitterに投稿</a>
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
        @endif

@endsection
