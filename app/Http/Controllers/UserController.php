<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    //
    public function getSignup(){
        $title = '新規登録';
        return view('user.signup',[
            'title' => $title,
            ]);
    }
    
    public function getProfile(){
        $title = '登録完了';
        return view('user.profile',[
            'title' => $title,    
        ]);
    }
    
    public function postSignup(Request $request){
        // バリデーション
        $this->validate($request,[
           'group_name' => 'required|unique:groups',
           'password' => 'required|min:4',
        ]);
        
        //DBインサート
        $group = new User([
            'group_name' => $request->input('group_name'),
            'password' => bcrypt($request->input('password')),
        ]);
        
        // 保存
        $group->save();
        
        // リダイレクト
        return redirect()->route('user.profile');
        
    }
    
    public function getSignin(){
        $title = 'トップページ';
        return view('user.signin', [
            'title' => $title,
        ]);
    }
    
    public function postSignin(Request $request){
        // バリデーション
        $this->validate($request,[
            'group_name' => 'required',
            'password' => 'required|min:4'
            ]);
        // 認証（attemptメソッド）

        //if (Auth::guard('groups')->attempt(['group_name' => $request->input('group_name'), 'password' => $request->input('password')])){
        //    return redirect('/messages');
        //}
        if(Auth::attempt(['group_name' => $request->input('group_name'), 'password' => $request->input('password')])){
            return redirect('/messages');
        }
        return redirect()->back();
        
    }
    
    public function getLogout(Request $request){

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('user.signin');
    }
}
