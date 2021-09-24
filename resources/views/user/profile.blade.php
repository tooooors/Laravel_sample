@extends('layouts.default')

@section('title', $title)

@section('content')
<div class="text-center mt-5 p-5">
    <h3>新規登録完了</h3>
    <a href="{{ route('user.signin') }}">ログイン画面へ戻る</a>
</div>
@endsection
