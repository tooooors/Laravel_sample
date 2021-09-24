@extends('layouts.default')

@section('title',$title)

@section('content')
<div class="modal fade" id="insertMessage">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3>メッセージをご記入ください</h3>
                <button class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="{{ url('/messages') }}">
                {{ csrf_field() }}
                <div class="form-group mt-1">
                    <div class="modal-body">
                        <labrl for="title" class="m-1">タイトル</labrl>
                        <input type="text" class="form-control" id="title" name="title">
                        <label for="message" class="m-1">メッセージ</label>
                        <textarea class="form-control" id="message" name="message" rows="5"></textarea>
                    </div>
                    <div class="modal-fotter">
                        <div class="text-right mr-5">
                            <input type="submit" class="btn btn-primary" value="追加"> 
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="container mt-5">
    <div class="row">
        <p class="m-2">{{ $group_name }}の掲示板　ホーム</p>
        <a href="#" class="btn btn-success m-2" data-toggle="modal" data-target="#insertMessage">メッセージを追加</a>
    </div>
    @foreach($errors->all() as $error)
    <p class="text-danger m-1">{{ $error }}</p>
    @endforeach
   <div class="row" style="width: 900px;">
       @forelse($messages as $message)
       <div class="col-4">
           <div class="card border-primary m-2">
               <h4 class="card-header bg-primary text-white p-2">{{ $message->title }}</h4>
               <div class="card-body p-1">
                   <p>{{ $message->message }}</p>
                   <p class="text-right text-secondary m-0">更新: {{ $message->updated_at }}</p>
                   <p class="text-right text-secondary m-0">登録: {{ $message->created_at }}</p>
               </div>
               <div class="card-footer p-1 text-secondary text-right">
                   <div class="row justify-content-end mr-1">
                       <div>
                        <button class="btn border-0 text-secondary" data-toggle="modal" data-target="#modal{{ $message->id }}">
                            <span data-toggle="tooltip" title="編集する">
                                <i class="fas fa-pencil-alt"></i>
                            </span>
                        </button>   
                       </div>
                       <div>
                       <form method="post" action="{{ url('/updateStatus')}}">
                           {{ csrf_field() }}
                           <input type="hidden" name="id" value="{{ $message->id }}">
                           <input type="hidden" name="status" value="1">
                           <button type="submit" class="btn border-0 text-secondary">
                               <span data-toggle="tooltip" title="アーカイブに移動させる">
                                   <i class="fas fa-archive"></i>
                               </span>
                            </button>
                       </form>    
                       </div>
                   </div>
               </div>
           </div>
       </div>
       <div class="modal fade" id="modal{{ $message->id }}">
           <div class="modal-dialog">
               <div class="modal-content">
                   <div class="modal-header">
                       <h3 class="modal-title">メッセージを編集してください</h3>
                       <button class="close" data-dismiss="modal">
                           <span aria-hidden="true">&times;</span>
                       </button>
                   </div>
                   <form method="post" action="{{ url('/updateMessage') }}">
                        {{ csrf_field() }}
                        <div class="form-group mt-1">
                            <div class="modal-body">
                                <labrl for="title" class="m-1">タイトル</labrl>
                                <input type="text" class="form-control" id="title" name="title" value="{{ $message->title }}">
                                <label for="message" class="m-1">メッセージ</label>
                                <textarea class="form-control" id="message" name="message" rows="5">{{ $message->message }}</textarea>
                            </div>
                            <div class="modal-fotter">
                                <div class="text-right mr-5">
                                    <input type="hidden" name="id" value="{{ $message->id }}">
                                    <input type="submit" class="btn btn-primary" value="変更"> 
                                </div>
                            </div>
                        </div>
                    </form>
               </div>
           </div>
       </div>
       @empty
       <p>メッセージはありません</p>
       @endforelse
   </div>
</div>

@endsection