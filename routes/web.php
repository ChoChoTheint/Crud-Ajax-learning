<?php

use App\Http\Controllers\TeacherController;
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
Route::get('index','TeacherController@index');
Route::get('/teacher/all','TeacherController@allTeacher')->name('allTeacher');
Route::post('/teacher/store/','TeacherController@storeTeacher')->name('storeTeacher');
Route::get('/teacher/edit/{id}','TeacherController@editTeacher')->name('editTeacher');
Route::post('/teacher/update/{id}','TeacherController@updateTeacher')->name('updateTeacher');