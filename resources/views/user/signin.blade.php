@extends('layouts.default')

@section('title', $title)

@section('content')
<div class="container-fluid m-5 p-5">
    <h1>簡単に情報共有しよう</h1>
    <p>グループの登録だけで、離れている人とも簡単に情報共有ができます。</p>
    <a class="btn btn-primary m-1" href="{{ route('user.signup')}}">グループを新規登録して始める</a>
    <h2 class="mt-5">グループ登録済みの方はコチラからログイン</h2>
    @foreach($errors->all() as $error)
    <p class="text-danger m-2">{{ $error }}</p>
    @endforeach
    <div class="row">
        <form action="{{ route('user.signin') }}" method="post" class="form-horizontal col-10" style="margin-top: 10px;">
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
                    <input type="submit" class="btn btn-primary btn-block" value="ログイン">
                </div>
            </div>
            {{ csrf_field() }}
        </form>
    </div>
    <h4 class="mt-3">使い方</h4>
    <div class="row" style="width: 960px;">
        <div class="col-4">
            <figure>
                <figcaption>1．グループを作成する</figcaption>
                <img style="width: 300px;" src="/images/groupPic.jpg">
            </figure>
        </div>
        <div class="col-4">
            <figure>
                <figcaption>2．グループ名を共有する</figcaption>
                <img style="width: 300px;" src="/images/handOverPic.jpg">    
            </figure>
        </div>
        <div class="col-4">
            <figure>
                <figcaption>3．情報共有を始める</figcaption>
                <img style="width: 300px;" src="/images/sharePic.jpg">
            </figure>
        </div>
    </div>
</div>
@endsection
