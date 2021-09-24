<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;
use Illminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;

class MessagesController extends Controller
{
    //
    public function index(){
        $title = 'ホーム';
        // Messageモデルを利用してmessageの一覧を取得
        $messages = \App\Models\Message::where('status',0)->where('group_id',Auth::id())->orderBy('updated_at', 'desc')->get();
        // 復号化
        $messages = $this->decryptionMessages($messages);
        $group = Auth::user();
        $group_name = $group['group_name'];
        // views/messages/index.blade.phpを指定
        return view('messages.index', [
            'title' => $title,
            'messages' => $messages,
            'group_name' => $group_name,
            ]);
    }
    
    // メッセージ復号化
    public function decryptionMessages($messages){
        try {
            foreach ($messages as $message){
                $message['title'] = Crypt::decryptString($message['title']);
                $message['message'] = Crypt::decryptString($message['message']);
            } 
            }catch (DecryptException $e) {
                throw $e;
        }
        return $messages;
    }
    
    public function create(Request $request){
        // バリデーション
        $this->validate($request,[
           'title' => 'required',
           'message' => 'required',
        ]);
        
        //DBインサート
        $message = new Message([
            'title' => Crypt::encryptString($request->input('title')),
            'message' => Crypt::encryptString($request->input('message')),
            'group_id'=> Auth::id(),
            'status' => 0,
        ]);
        
        // 保存
        $message->save();
        
        // リダイレクト
        return redirect('/messages');
    }
    
    public function updateStatus(Request $request){
        // バリデーション
        $this->validate($request,[
           'id' => 'required|integer',
           'status' => 'required|digits:1',
        ]);
        // DBアップデート
        $message = new Message;
        $message->where('id', $request->input('id'))->update(['status' => $request->input('status')]);
        // 保存
        $message->update();
        
        return back();
    }
    
    public function updateMessage(Request $request){
        // バリデーション
        $this->validate($request,[
            'id' => 'required|integer',
            'title' => 'required',
            'message' => 'required',
        ]);
        // DBアップデート
        $message = new Message;
        $message->where('id', $request->input('id'))->update([
            'title' => Crypt::encryptString($request->input('title')),
            'message' => Crypt::encryptString($request->input('message')),
        ]);
        // 保存
        $message->update();
        return back();
    }
    
    public function deleteMessage(Request $request){
        // バリデーション
        $this->validate($request,[
            'id' => 'required|integer',
        ]);
        // メッセージ消去
        \App\Models\Message::where('id', $request->input('id'))->delete();
        return back();
    }
    
    public function archive(){
        $title = 'アーカイブ';
        $messages = \App\Models\Message::where('status', 1)->where('group_id',Auth::id())->latest()->get();
        $messages = $this->decryptionMessages($messages);
        $group = Auth::user();
        $group_name = $group['group_name'];
        return view('messages.archive',[
            'title' => $title,
            'messages' => $messages,
            'group_name' => $group_name,
        ]);
    }
}
