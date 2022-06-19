@extends('layouts.app')

@section('content')
        <div class="container border-flame w-9 py-sm-5 py-3 my-5 panel-bg">
            <h2 class="fs-4 text-center mb-3">勉強お疲れ様でした。</h2>
            <div class="border-flame w-sm-50 m-auto bg-white exit-board">
                <dl class="total-time text-center mt-3">
                    <dt>総勉強時間</dt>
                    <dd>60:00</dd>
                </dl>
                <h3 class="text-center fs-4">勉強内容</h3>
                <div class="m-auto w-25 text-center mb-5">
                    <p class="m-0">PHP</p>
                    <p class="m-0">Laravel</p>
                </div>
            </div>
            <p class="text-center mt-4">勉強した記録にツイートしてみませんか？</p>
            <a href="＃" alt="Twitterに投稿" type="button" class="btn join-btn my-3">Twitterに投稿</a>
        </div>

        <div class="container border-flame w-9 py-sm-5 py-3 my-5">
            <h3 class="text-center">新規会員登録</h3>
            <p class="text-center">
            会員登録をしていただくと、 勉強した時間の記録を残すことができます。
            </p>

            <div class="col-sm-6 m-auto mt-5">
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

            <input class="btn register-button my-5" type="button" value="新規会員登録">
        </div>


@endsection
