@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('メールアドレスの確認') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('入力いただいたメールアドレスへ、認証メールを送信しました') }}
                        </div>
                    @endif

                    {{ __('お送りしたメール内にある確認リンクを押して、会員登録を完了してください。') }}
                    {{ __('メールが届いていない方') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('こちらをクリックして、運営へお問い合わせください') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
