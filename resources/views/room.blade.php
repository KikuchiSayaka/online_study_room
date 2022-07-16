@extends('layouts.app')

@section('js')
    <script src="{{ asset('js/timer.js') }}" defer></script>
    <script src="{{ asset('js/userInfo.js') }}" defer></script>
    <script src="{{ asset('js/pomodoroTimer.js') }}" defer></script>
@endsection

@section('content')

        <div class="container d-sm-flex justify-content-center my-sm-5 my-3">
            <div class="room-list border-flame px-sm-5 px-2 py-5">
                <div class="d-flex justify-content-around">
                    <dl class="total-time">
                        <dt>総勉強時間</dt>
                        <dd id="timer">00:00:00</dd>
                    </dl>
                    <dl class="pomodoro_timer">
                        <dt>ポモドーロタイマー</dt>
                        <dd>学習 <span id="pomodoro-timer">25:00</span></dd>
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
                    <p class="">入力するとあなたの席に反映されます。同じお部屋の人にも見えるので、トラブル防止のため、個人情報は入力しないようにしましょう。</p>

                    <form method="POST" action="{{ route('user.update') }}">
                        @csrf
                        <div class="input-group flex-nowrap my-2">
                            <input id="your-name" type="text" class="form-control" placeholder="あなたのユーザー名" aria-label="あなたのユーザー名" aria-describedby="addon-wrapping">
                        </div>
                        <div class="input-group flex-nowrap">
                            <input id="learning-content" type="text" class="form-control" placeholder="勉強内容" aria-label="勉強内容" aria-describedby="addon-wrapping">
                        </div>
                        <input id="your-info-btn" class="btn side-button" type="button" value="変更">
                    </form>
                </div>
                <div class="side_bar_item  mt-sm-5 mt-4">
                    <p class="text-center mt-5">疲れたら休憩しましょう。一時的にタイマーが止まります。</p>
                    <button id="stop" class="btn side-button">休憩</button>
                </div>
                <div class="side_bar_item  mt-sm-5 mt-4">
                    <p class="text-center">勉強をやめるときはこちらへ</p>
                    <form method="POST" action="{{ route('exit.index') }}">
                        @csrf
                        {{-- <a href="/exit" class="btn side-button" type="button">退室</a> --}}
                        <button class="btn side-button">退室</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="container border-flame w-9 py-sm-5 py-3 my-5">
            <h3 class="text-center">新規会員登録</h3>
            <p class="text-center">
            会員登録をしていただくと、 勉強した時間の記録を残すことができます。
            </p>

            <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('ユーザー名') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Eメールアドレス') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('パスワード') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

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
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary px-5 py-2 mt-3 mb-5">
                                    {{ __('登録') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

            <!-- <div class="col-sm-6 m-auto mt-5">
                <input type="text" class="form-control" placeholder="ユーザーネーム" aria-label="ユーザーネーム" aria-describedby="addon-wrapping">
            </div>
            <div class="col-sm-6 m-auto my-2">
                <input type="text" class="form-control" placeholder="メールアドレス" aria-label="メールアドレス" aria-describedby="addon-wrapping">
            </div>
            <div class="col-sm-6 m-auto mt-4">
                <input type="text" class="form-control" placeholder="パスワード" aria-label="パスワード" aria-describedby="addon-wrapping">
            </div>
            <div class="col-sm-6 m-auto my-2">
                <input type="text" class="form-control" placeholder="確認のためもう一度パスワードを入力してください" aria-label="パスワード確認" aria-describedby="addon-wrapping">
            </div>

            <input class="btn register-button my-5" type="button" value="新規会員登録"> -->
        </div>
@endsection


