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

Route::group(['middleware'=>'prevent-back-history'], function(){
    Auth::routes();
    Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');
    Route::get('/user', 'HomeController@user')->name('user')->middleware('auth');
    Route::get('/questForm', 'QuestController@form')->name('questForm')->middleware('auth');
    Route::get('/subjects', 'SubjectController@index')->name('subjects')->middleware('auth');
    Route::get('/subjectForm','SubjectController@form')->name('subjectForm')->middleware('auth');
    Route::get('/showQuest', 'QuestController@showQuest')->name('showQuest')->middleware('auth');
    Route::get('/showQuestById/{id}', 'QuestController@questByID')->name('showQuestByID')->middleware('auth');
    Route::get('/posts','PostController@index')->name('posts')->middleware('auth');
    Route::get('/postForm','PostController@form')->name('postForm')->middleware('auth');

    Route::post('/addQuest','QuestController@addQuest')->middleware('auth');
    Route::post('/addSubject','SubjectController@addSubject')->middleware('auth');
    Route::post('/postQuest','PostController@postQuest')->middleware('auth');
});

Route::get('/logout', 'Auth\LogoutController@index')->name('logout');

