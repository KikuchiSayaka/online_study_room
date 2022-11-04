@extends('layouts.app')

@section('title')
| 席次表・タイマー画面 | オンライン自習室
@endsection

@section('js')
    <script src="{{ asset('js/timer.js') }}" defer></script>
    <script src="{{ asset('js/userInfo.js') }}" defer></script>
@endsection

@section('content')

        <div class="first-contents">
            @if( !Auth::user()->email_verify_at && Auth::user()->email)
                <h2 class="fs-5 text-md-center attention text-white p-2 bg-danger">
                    現在仮登録中です。お送りしたメールにあるリンクボタンを押して、本登録処理を完了してください。
                </h2>
            @endif
            <div class="container d-sm-flex justify-content-center my-sm-4 my-3">
                <div class="room-list border-flame px-sm-5 px-2 py-5">
                    <div class="d-flex justify-content-around">
                        <dl class="total-time">
                            <dt>総勉強時間</dt>
                            <dd id="timer">00:00:00</dd>
                        </dl>
                        <dl class="pomodoro_timer">
                            <dt>ポモドーロタイマー</dt>
                            <dd>
                                <span id="work-or-rest">学習</span>
                                <span id="pomodoro-timer">25:00</span>
                            </dd>
                        </dl>
                    </div>
                    <div class="seating_chart text-center">
                        <div class="seat" id="yourData">
                            <h3 id="your-name-output" class="guest_name fw-bold">あなた</h3>
                            <div id="learning-content-output" class="learning_content">勉強内容</div>
                            <div id="room_timer" class="time">00:00:00</div>
                        </div>

                        @foreach ($users as $user)
                            <div class="seat other seatChange">
                                <h3 class="guest_name fw-bold">{{ $user->name }}</h3>
                                <div class="learning_content">{{ $user->learning_content }}</div>
                                <div class="time">{{ $user->total_minutes }}</div>
                            </div>
                        @endforeach

                        @for ($i = 0; $i < $vacancies; $i++)
                            <div class="seat vacancy seatChange">
                                <h3 class="guest_name fw-bold">空室</h3>
                                <div class="learning_content"></div>
                                <div class="time"></div>
                            </div>
                        @endfor
                    </div>
                </div>
                <div class="side_bar col-sm-3 ms-sm-3">
                    <div class="side_bar_item  mt-sm-5 mt-4">
                        <p class="">入力するとあなたの席に反映されます。同じお部屋の人にも見えるので、トラブル防止のため個人情報は入力しないようにしましょう。</p>

                        <form method="POST" action="{{ route('user.update') }}">
                            @csrf
                            <div class="input-group flex-nowrap my-2">
                                <input id="your-name" type="text" class="form-control" placeholder="新しいユーザー名(最大10文字)" aria-label="新しいユーザー名(最大10文字)" aria-describedby="addon-wrapping">
                            </div>
                            <div class="input-group flex-nowrap">
                                <input id="learning-content" type="text" class="form-control" placeholder="勉強内容(最大10文字)" aria-label="勉強内容(最大10文字)" aria-describedby="addon-wrapping">
                            </div>
                            <input id="your-info-btn" class="btn side-button" type="button" value="変更">
                        </form>
                    </div>
                    <div class="side_bar_item  mt-sm-5 mt-4">
                        <p class="text-center mt-5">
                            疲れたら休憩しましょう。<br>
                            一時的にタイマーが止まります。
                        </p>
                        <button id="stop" class="pause-button">休憩</button>
                    </div>
                    <div class="side_bar_item  mt-sm-5 mt-4">
                        <p class="text-center">勉強をやめるときはこちらへ</p>
                        <form method="POST" action="{{ route('exit.index') }}">
                            @csrf
                            {{-- <a href="/exit" class="exit-button" type="button">退室</a> --}}
                            <button class="exit-button">退室</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @if(empty($email))
            <div id="create-account-form" class="container border-flame w-9 py-5 my-5">
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
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" placeholder="山田花子(最大10文字)">

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
                        <!-- </div> -->
                    </form>
                </div>
            </div>

            <div id="registration-completed" class="pb-5">
                <div class="container border-flame w-9 py-sm-5 py-5 my-5">
                    <div class="wrap">
                        <h3 class="mb-4 text-center">仮登録が完了しました</h3>
                        <p class="mb-2">入力いただいたメールアドレスへ仮登録確認のメールをお送りしました。</p>
                        <p class="mb-5">メール内にある確認リンクを押して、会員登録を完了してください。</p>
                        <p class="mb-5">メールが届いていない方は、<a href="#">こちら</a>より運営へお問い合わせください。</p>
                        <p class="fz-7">※ ご登録いただいた情報の変更はヘッダーメニューのマイページより変更いただけます。</p>
                    </div>
                </div>
            </div>
        @endif
@endsection


