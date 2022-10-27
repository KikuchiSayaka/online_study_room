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

        <div class="top-cover">
            <div class="container">
                <h2 class="text-center pt-5 mt-5 mb-1">登録なしですぐ始められるオンライン自習室</h2>
                <p class="text-center m-3 fs-5">ボタンを押すとすぐに勉強が始められます。</p>
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <button class="btn join-btn">入室</button>
                </form>
            </div>
        </div>

@endsection
