@extends('layouts.app')

@section('content')

    <div class="container border-flame w-9 py-sm-5 py-3 my-5">
        <h2 class="text-center">勉強記録</h3>
        <table class="table">
            <thead class="main-bg-color">
                <tr>
                <th scope="col text-center">日付</th>
                <th scope="col">勉強時間</th>
                <th scope="col">勉強内容</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($records as $record)
                    <tr>
                        <th scope="row">
                            <div class="date">{{ $record->updated_at->format("Y/m/d") }}</div>
                            <div class="time">{{ $record->updated_at->format("H:i") }}</div>
                        </th>
                        <td>{{ $record->total_minutes }}分</td>
                        <td>{{ $record->learning_content }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection
