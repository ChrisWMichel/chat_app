<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/
Route::post('/register', 'Auth\RegisterController@RegisterUser');
Route::get('/logout', 'AuthController@logout')->name('logout');

Route::get('/user_list', 'UserController@userList')->name('user_list');
Route::post('/get_user_conversatoin', 'ChatController@userConversation')->name('user_conversation');
Route::post('/add_new_chat', 'ChatController@addNewChat');