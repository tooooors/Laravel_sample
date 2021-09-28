@extends('layouts.default')

@section('title', $title)

@section('content')
<div class="container-fluid m-5 p-5">
    <h1>グループを新規登録する</h1>
    <p>グループ名とパスワードを入力してください</p>
    @foreach($errors->all() as $error)
    <p class="text-danger m-2">{{ $error }}</p>
    @endforeach
    <div class="row">
        <form action="{{ route('user.signup') }}" method="post" class="form-horizontal col-10" style="margin-top: 10px;">
            <div class="form-group">
                <label class="control-label" for="inputname">グループ名</label>
                <div style="width: 400px">
                    <input type="text" name="group_name" class="form-control" id="inputname" placeholder="グループ名">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label" for="inputpassword">パスワード</label>
                <div style="width: 400px">
                    <input type="password" name="password" class="form-control" id="inputpassword" placeholder="パスワード">
                </div>
            </div>
            <div class="form-group">
                <div class="m-1" style="width: 200px">
                    <input type="submit" class="btn btn-primary btn-block" value="新規登録">
                </div>
            </div>
            {{ csrf_field() }}
        </form>
    </div>
    <div class="mt-3">
        <a href="{{ route('user.signin') }}" class="ml-3">トップページに戻る</a>
    </div>
</div>
@endsection