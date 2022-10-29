@extends('layouts.app')

@section('title')
オンライン自習室 | 無料・アカウント登録なし！ポモドーロタイマー付き。社会人、中学生、小学生、高校生、大学生、誰でも使えるアプリです。
@endsection

@section('description')
オンライン自習室は、完全無料・アカウント登録なし！ポモドーロタイマー付き。社会人、中学生、小学生、高校生、大学生、誰でもOK！他の人とリアルタイムで一緒に頑張れるタイマーアプリです。
@endsection

@section('ogp')
    <head prefix="og: https://ogp.me/ns#">
    <meta property="og:url" content="online-study-room.jp" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="オンライン自習室" />
    <meta property="og:description" content="オンライン自習室 | 無料・アカウント登録なし！ポモドーロタイマー付き。社会人、中学生、小学生、高校生、大学生、誰でも気軽に使えます。" />
    <meta property="og:site_name" content="オンライン自習室" />
    <meta property="og:image" content=" サムネイル画像のURL" />
    <meta name="twitter:card" content="app" />
    <meta name="twitter:site" content="@online-study-room" />
@endsection

@section('content')

        <div class="first-content top-cover text-white main-bg-color first-contents">
            <div class="container">
                <div class="d-md-flex align-items-center m-auto justify-content-center">
                    <div class="right">
                        <h2 class="mb-1 fs-2 fw-bolder">
                            登録なしですぐ始められる</br>
                            <span class="fs-1 mt-1">オンライン自習室</span>
                        </h2>
                        <p class="mt-3 fs-md-5">
                            入室ボタンを押すと、すぐにポモドーロタイマー付き自習室で勉強が始められます。
                            </br>
                            面倒なアカウント登録はありません。
                        </p>
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <button class="btn join-btn">入室</button>
                        </form>
                    </div>
                    <div class="left">
                        <img src="{{ asset('assets/main_visual.png') }}" alt="オンライン自習室のメイン画像">
                    </div>
                </div>
            </div>
        </div>
        <div class="container panel-bg">
                <h2 class="heading-color text-center fs-2 pt-5 my-5 fw-bolder">
                    オンライン自習室の使い方
                </h2>
                <div class="grid4">
                    <div class="grid-item">
                        <h3 class="heading-color fs-5 text-center fw-bold">
                            入室ボタンを押して<br>
                            自習室へ入室
                        </h3>
                        <img class="d-block m-auto my-3" src="{{ asset('assets/in_button.png') }}" alt="オンライン自習室へは入室ボタンを押して入りましょう">
                        <p>
                            入室ボタンを押せば、誰でもオンライン自習室へ参加できます。面倒なアカウント登録は必要ありません。
                        </p>
                    </div>
                    <div class="grid-item">
                        <h3 class="heading-color fs-5 text-center fw-bold">
                            ポモドーロタイマーが<br>
                            カウント開始
                        </h3>
                        <img class="d-block m-auto my-3" src="{{ asset('assets/timer.png') }}" alt="オンライン自習室は入室入室するとタイマーが動きます。">
                        <p>
                            自習室に入室するとポモドーロタイマーのカウントが始まります。タイマーの表示に合わせて学習しましょう。
                        </p>
                    </div>
                    <div class="grid-item">
                        <h3 class="heading-color fs-5 text-center fw-bold">
                            一緒に勉強している<br>
                            仲間の学習時間も<br>
                            確認できます
                        </h3>
                        <img class="d-block m-auto my-3" src="{{ asset('assets/member_list.png') }}" alt="オンライン自習室へは入室ボタンを押して入りましょう">
                        <p>
                            入室ボタンを押せば、誰でもオンライン自習室へ参加できます。面倒なアカウント登録は必要ありません。
                        </p>
                    </div>
                    <div class="grid-item">
                        <h3 class="heading-color fs-5 text-center fw-bold">
                            学習が終わったら<br>
                            退室ボタンで退室
                        </h3>
                        <img class="d-block m-auto my-3" src="{{ asset('assets/out_button.png') }}" alt="オンライン自習室へは入室ボタンを押して入りましょう">
                        <p>
                            学習が終了したら退室ボタンで退室しましょう。また休憩ボタンもあるので、タイマーを一時停止したい時は活用してください。
                        </p>
                    </div>
                </div>
            </div>

@endsection
