@extends('layouts.app')

@section('title')
| 学習終了 | オンライン自習室
@endsection

@section('ogp')
    <head prefix="og: https://ogp.me/ns#">
    <meta property="og:url" content="http://127.0.0.1:8000" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="オンライン自習室" />
    <meta property="og:description" content="アカウント登録なしですぐ始められる！ポモドーロタイマー付きオンライン自習室です。" />
    <meta property="og:site_name" content="オンライン自習室" />
    <meta property="og:image" content=" サムネイル画像のURL" />
    <meta name="twitter:card" content="app" />
    <meta name="twitter:site" content="@online-study-room" />
@endsection

@section('js')
    <script src="{{ asset('js/exit.js') }}" defer></script>
@endsection

@section('content')
    <div class="first-contents">
        @if(!Auth::user()->email_verify_at)
                <h2 class="fs-5 text-center attention text-white py-2 bg-danger">
                    現在仮登録中です。お送りしたメールにあるリンクボタンを押して、本登録処理を完了してください。
                </h2>
        @endif
        <div class="container border-flame w-9 py-sm-5 py-3 my-4">
            <h2 class="fs-4 text-center mb-3">勉強お疲れ様でした。</h2>

            <canvas id="canvas" width="300px" height="200px" class="border-flame w-sm-50 m-auto bg-white exit-board" style="display: flex; justify-content: center;"></canvas>

            <p class="text-center mt-4">勉強した記録にツイートしてみませんか？</p>

            <a href="https://twitter.com/share?ref_src=twsrc%5Etfw&amp;text=※※ぜひ先ほどダウンロードされた画像を添付してツイートしてください※※%0a%0aオンライン自習室で、先ほどまで{{ $user->total_minutes }}分 勉強しました。%0a%0a勉強内容：{{ $user->learning_content }}%0a%0a%23勉強垢%0a%23今日の積み上げ%0a%23勉強%0a%23勉強垢さんと頑張りたい%0a%23自習室%0a登録なしですぐ始められる%7C%7Cオンライン自習室%7C%7C" class="btn join-btn my-3"
                onclick="CanvasDataDownload();"
                data-text="オンライン自習室で、先ほどまで{{ $user->total_minutes }}分 勉強しました。%0a%0a勉強内容：{{ $user->learning_content }}"
                data-hashtags="勉強垢勉強垢,今日の積み上げ,勉強,勉強垢さんと頑張りたい,自習室"
                data-show-count="false"
                target="_blank"
                rel="nofollow"
            >
                Twitterに投稿
            </a>
        </div>
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
    @endif

@endsection
@section('javascript')
    <script>
        let total_minutes = '{{ $user->total_minutes }}'+'分';
        let learning_content = '{{ $user->learning_content }}';
        window.onload = () => {
            let canvas = document.getElementById('canvas');  // HTMLCanvasElement
            let ctx = canvas.getContext('2d');  // CanvasRenderingContext2D

            ctx.beginPath();
            ctx.fillStyle = '#fff';
            ctx.fillRect(0, 0, canvas.width, canvas.height);

            ctx.textAlign = 'center';
            ctx.font = 'bold 2rem sans-serif';
            ctx.fillStyle = '#969696';
            ctx.fillText('総勉強時間', 150, 50);
            ctx.font = 'bold 3rem sans-serif';
            ctx.fillStyle = '#5f5f5f';
            ctx.fillText(total_minutes, 150, 110);
            ctx.font = '1.1rem sans-serif';
            ctx.fillStyle = '#000';
            ctx.fillText('勉強内容', 150, 150);
            ctx.font = '0.8rem sans-serif';
            ctx.fillText(learning_content, 150, 175);

        };

    function CanvasDataDownload( canvas_id_name, download_file_name ) {
        let canvas = document.getElementById('canvas');
        let type = 'image/jpg';
        let dataurl = canvas.toDataURL(type);
        let bin = atob(dataurl.split(',')[1]);
        let buffer = new Uint8Array(bin.length);
        for (let i = 0; i < bin.length; i++) {
            buffer[i] = bin.charCodeAt(i);
        }
        let blob = new Blob([buffer.buffer], {type: type});

        let link = document.createElement("a");
        link.href = window.URL.createObjectURL(blob);
        link.download = download_file_name;
        link.click();
    }
    </script>
    <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
@endsection
