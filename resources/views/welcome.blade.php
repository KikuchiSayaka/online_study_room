@extends('layouts.app')

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
