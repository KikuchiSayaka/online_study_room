@extends('layouts.app')

@section('content')

    <div class="container border-flame w-9 py-sm-5 py-3 my-5">
        <h2 class="text-center">勉強記録</h3>

        @foreach ($records as $record)
            <dl class="d-flex border-bottom p-1">
                <dt class="p-1">{{ $record->updated_at }}</dt>
                <dd class="p-1">{{ $record->learning_content }}</dd>
                <dd class="p-1">{{ $record->total_minutes }}</dd>
            </dl>
        @endforeach
    </div>

@endsection
