@extends('layouts.default')

@section('title',$title)

@section('content')
<div class="container mt-5">
    <div class="row">
        <p class="m-2">{{ $group_name }}の掲示板　アーカイブ</p>
    </div>
    @foreach($errors->all() as $error)
    <p class="text-danger m-1">{{ $error }}</p>
    @endforeach
    <div class="row" style="width: 900px;">
       @forelse($messages as $message)
       <div class="col-4">
           <div class="card border-secondary">
                <div class="card-header bg-light p-2">
                    <a href="#" class="close" data-toggle="modal" data-target="#modal">
                        <span aria-hidden="true" data-toggle="tooltip" title="削除する">&times;</span>
                    </a>
                    <h4>{{ $message->title }}</h4>
                </div>
               <div class="card-body p-1">
                   <p>{{ $message->message }}</p>
                   <p class="text-right text-secondary m-0">更新: {{ $message->updated_at }}</p>
                   <p class="text-right text-secondary m-0">登録: {{ $message->created_at }}</p>
               </div>
               <div class="card-footer p-1 text-secondary text-right">
                   <form method="post" action="{{ url('/updateStatus')}}">
                       {{ csrf_field() }}
                       <input type="hidden" name="id" value="{{ $message->id }}">
                       <input type="hidden" name="status" value="0">
                       <button type="submit" class="btn border-0" data-toggle="tooltip" title="ホームに戻す"><i class="fas fa-home"></i></button>
                   </form>
               </div>
           </div>
       </div>
       <div class="modal fade" id="modal">
           <div class="modal-dialog">
               <div class="modal-content">
                   <div class="modal-header">
                       <h3 class="modal-title">メッセージを削除</h3>
                       <button class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                        </button>
                   </div>
                   <div class="modal-body">
                       メッセージを完全に削除してもよろしいでしょうか。
                       <div class="row justify-content-end">
                           <form method="post" action="{{ url('/deleteMessage') }}">
                               {{ csrf_field() }}
                               <input type="hidden" name="id" value="{{ $message->id }}">
                               <input type="submit" class="btn btn-danger m-2" value="削除">
                           </form>
                           <button class="btn btn-secondary m-2" data-dismiss="modal">キャンセル</button>
                       </div>
                   </div>
               </div>
           </div>
       </div>
       @empty
       <p>メッセージはありません</p>
       @endforelse
   </div>
</div>

@endsection