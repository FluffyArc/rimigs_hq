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
    return view('client.clientlogin');
});

/*Route::get('admin/login','Auth\LoginController@showLoginForm')->name('login');
Route::post('admin/login','Auth\LoginController@login');
Route::get('admin.logout','Auth\LoginController@logout')->name('logout');

Route::get('admin/register','Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('admin/register','Auth\RegisterController@register');

Route::get('/login','ClientController@login')->name('loginClient');*/


Auth::routes();


/*Route::group(['middleware'=>'auth'], function(){
   Route::get('permissions-admin',['middleware'=>'check-permission:admin','uses'=>'HomeController@index']);
   Route::get('permissions-user',['middleware'=>'check-permission:user','uses'=>'HomeController@user']);
});*/

Route::group(['middleware'=>['prevent-back-history','auth']], function(){
    //Admin Routes
    Route::get('/home', 'HomeController@index')->name('home')->middleware('admin');

    Route::get('/user', 'HomeController@user')->name('user');

    Route::get('questForm', 'QuestController@form')->name('questForm');
    Route::get('questForm', 'SubjectController@getSubjectName')->name('questForm');

    Route::get('subjects', 'SubjectController@index')->name('subjects');
    Route::get('subjectForm','SubjectController@form')->name('subjectForm');
    Route::get('showQuest', 'QuestController@showQuest')->name('showQuest');

    Route::get('showQuestById/{id}', 'PostController@studentsAndQuestsById');
    Route::get('editQuest/{id}', 'QuestController@editQuest')->name('editQuest');

    Route::get('posts','PostController@index')->name('posts');

    Route::get('postForm','PostController@form')->name('postForm');
    Route::get ('userForm', 'UserController@index')->name('userForm');

    Route::post('addQuest','QuestController@addQuest')->name('addQuest');
    Route::post('addSubject','SubjectController@addSubject');
    Route::post('postQuest','PostController@postQuest')->name('postQuest');
    Route::post('updateQuest/{id}', 'QuestController@updateQuest')->name('updateQuest');
    Route::post('addStudent','StudentController@addStudent');

    Route::get('destroyQuest/{id}','QuestController@destroyQuest')->name('destroyQuest');

    //Student Routes
    Route::get('/clientHome','ClientController@home')->name('clientHome')->middleware('student');
    Route::get('clientLogin', 'ClientController@login')->name('clientLogin');
});

Route::get('logout', 'Auth\LogoutController@index')->name('logout');

