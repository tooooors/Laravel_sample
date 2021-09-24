<?php

use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => 'auth'], function(){
    Route::get('/messages', 'MessagesController@index');
    Route::post('/messages', 'MessagesController@create');
    Route::post('/updateStatus', 'MessagesController@updateStatus');
    Route::post('/updateMessage', 'MessagesController@updateMessage');
    Route::post('/deleteMessage', 'MessagesController@deleteMessage');
    Route::get('/archive', 'MessagesController@archive');
});


Route::group(['prefix' => 'user'], function() {
    // 登録
    Route::group(['middleware' => 'guest'], function(){
        Route::get('/signup',[
        'uses' => 'UserController@getSignup',
        'as' => 'user.signup'
        ]);
    Route::post('/signup',[
        'uses' => 'UserController@postSignup',
        'as' => 'user.signup'
        ]);
     // 新規登録画面
    Route::get('/profile',[
        'uses' => 'UserController@getProfile',
        'as' => 'user.profile'
    ]);
    // ログイン
    Route::get('/signin',[
        'uses' => 'UserController@getSignin',
        'as' => 'user.signin'
        ]);
    Route::post('/signin',[
        'uses' => 'UserController@postSignin',
        'as' => 'user.signin'
        ]);
    });
    
    
    Route::group(['middleware' => 'auth'], function(){
        // ログアウト
        Route::get('/logout',[
            'uses' => 'UserController@getLogout',
            'as' => 'user.logout'
        ]);
    });
});

