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

Route::get('admin/login','Auth\LoginController@showLoginForm')->name('login');
Route::post('admin/login','Auth\LoginController@login');
Route::get('admin.logout','Auth\LoginController@logout')->name('logout');

Route::get('admin/register','Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('admin/register','Auth\RegisterController@register');






//Auth::routes();


/*Route::group(['middleware'=>'auth'], function(){
   Route::get('permissions-admin',['middleware'=>'check-permission:admin','uses'=>'HomeController@index']);
   Route::get('permissions-user',['middleware'=>'check-permission:user','uses'=>'HomeController@user']);
});*/

Route::group(['middleware'=>['prevent-back-history','auth', 'admin']], function(){
    //Admin Routes
    Route::get('/home', 'HomeController@index')->name('home');

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
    Route::get('users', 'UserController@user')->name('users');

    Route::post('addQuest','QuestController@addQuest')->name('addQuest');
    Route::post('addSubject','SubjectController@addSubject');
    Route::post('postQuest','PostController@postQuest')->name('postQuest');
    Route::post('updateQuest/{id}', 'QuestController@updateQuest')->name('updateQuest');
    Route::post('addStudent','UserController@addStudent')->name('addStudent');

    Route::get('destroyQuest/{id}','QuestController@destroyQuest')->name('destroyQuest');


});

Route::group(['middleware'=>['prevent-back-history','auth', 'student']], function(){
    //Student Routes

    Route::get('questList/{level}/{subject}','ClientController@quest')->name('questList');
    Route::get('questLevel/{subject}', 'ClientController@questLevel')->name('questLevel')->middleware('student');
    Route::get('questTaken','ClientController@questTaken')->name('questTaken')->middleware('student');
    Route::get('detail/{id_quest}','ClientController@detail')->name('detail')->middleware('student');
    Route::get('profile','ClientController@profile')->name('profile')->middleware('student');
    Route::get('subjects','ClientController@subjects')->name('subjects')->middleware('student');
    Route::get('changepass','ClientController@changepass')->name('changepass')->middleware('student');

    Route::post('changepass','ClientController@updatepass')->name('changepass')->middleware('student');
    Route::post('abort','ClientController@abortQuest')->middleware('student');
    Route::post('questDetail', 'ClientController@questDetail')->name('questDetail')->middleware('student');
    Route::post('questPost','ClientController@questPost')->middleware('student');


});
Route::get('clientLogin', 'ClientController@login')->name('clientLogin');
Route::post('clientLogin', 'Auth\LoginController@login');
Route::get('register','ClientController@register')->name('register');
Route::post('register','Auth\RegisterController@register');
Route::get('logout', 'Auth\LogoutController@index')->name('logout');

