@extends('layouts.app')

@section('content')

<div class="container border-flame w-9 py-sm-5 py-3 my-5 bg-white">
    <h2 class="fs-4 text-center mb-3">アカウントの本登録完了</h2>
    <div class="w-sm-50 m-auto bg-white exit-board">
        <p class="wrap my-4">本登録いただき、ありがとうございました。</p>
        <p class="wrap my-4">
            次回よりログインしてオンライン自習室にて学習をしていただくと、
            <a href="/my-page">マイページ</a>で学習記録を閲覧することができます。
        </p>
        <p class="wrap my-4">
            また、アカウント情報の変更も<a href="/my-page">マイページ</a>より行えます。
        </p>
    </div>
    <p class="text-center mt-5">さっそく学習を開始しますか？</p>
    <a href="/room" alt="オンライン自習室に入室" type="button" class="btn join-btn my-3">自習室に入室</a>
</div>

@endsection
