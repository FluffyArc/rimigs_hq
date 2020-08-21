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
    return view('client.questlist');
});

Auth::routes();

Route::group(['middleware'=>['prevent-back-history','auth']], function(){

    Route::get('home', 'HomeController@index')->name('home');
    Route::get('user', 'HomeController@user')->name('user');

    Route::get('questForm', 'QuestController@form')->name('questForm');
    Route::get('questForm', 'SubjectController@getSubjectName')->name('questForm');

    Route::get('subjects', 'SubjectController@index')->name('subjects');
    Route::get('subjectForm','SubjectController@form')->name('subjectForm');
    Route::get('showQuest', 'QuestController@showQuest')->name('showQuest');

    Route::get('showQuestById/{id}', 'PostController@studentsAndQuestsById');


    Route::get('posts','PostController@index')->name('posts');

    Route::get('postForm','PostController@form')->name('postForm');


    Route::post('addQuest','QuestController@addQuest');
    Route::post('addSubject','SubjectController@addSubject');
    Route::post('postQuest','PostController@postQuest');
});

Route::get('logout', 'Auth\LogoutController@index')->name('logout');

