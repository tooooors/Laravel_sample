@extends('layouts.default')

@section('title', $title)

@section('content')
<div class="container-fluid m-5 p-5">
    <h1>ログイン</h1>
    @foreach($errors->all() as $error)
    <p class="text-danger m-2">{{ $error }}</p>
    @endforeach
    <div class="row">
        <form action="{{ route('user.signin') }}" method="post" class="form-horizontal col-10" style="margin-top: 50px;">
            <div class="form-group">
                <label class="control-label" for="inputname">グループ名</label>
                <div class="col-10">
                    <input type="text" name="group_name" class="form-control" id="inputname" placeholder="グループ名">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label" for="inputpassword">パスワード</label>
                <div class="col-10">
                    <input type="password" name="password" class="form-control" id="inputpassword" placeholder="パスワード">
                </div>
            </div>
            <div class="form-group">
                <div class="col-5 m-1">
                    <input type="submit" class="btn btn-primary btn-block" value="ログイン">
                </div>
            </div>
            {{ csrf_field() }}
        </form>
    </div>
</div>
@endsection
