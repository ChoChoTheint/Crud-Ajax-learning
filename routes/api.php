<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix'=>'teacher','namespace'=>'API','middleware'=>'auth:sanctum'],function(){
    Route::get('list','ApiController@teacherList');
    Route::post('create','ApiController@teacherCreate');
    Route::get('detail/{id}','ApiController@teacherDetail');
    Route::get('delete/{id}','ApiController@teacherDelete');
    Route::post('update','ApiController@teacherUpdate');
});