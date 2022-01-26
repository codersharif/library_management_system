<?php

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
/*
  |App version 1.0
  |@author shariful islam khan

 */

//Route::get('/', function () {
//    if (Auth::check()) {
//        return redirect('dashboard');
//    } else {
//        return view('auth.login');
//    }
//});

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::group(['middleware' => 'auth'], function () {

Route::get('/users','UserController@index');
Route::get('/users/create','UserController@create');
Route::post('/users/store','UserController@store');
Route::get('/users/{id}/edit','UserController@edit');
Route::put('/users/update/{id}','UserController@update');
Route::delete('/users/{id}','UserController@destroy');

// USER GROUP
Route::get('/userGroup','UserGroupController@index');
Route::get('/userGroup/{id}/edit','UserGroupController@edit');
Route::put('/userGroup/update/{id}','UserGroupController@update');


//setRecordPerPage
Route::post('setRecordPerPage', 'UsersController@setRecordPerPage');

// STUDENT
Route::get('/student','StudentController@index');
Route::get('/student/create','StudentController@create');
Route::post('/student/store','StudentController@store');
Route::get('/student/{id}/edit','StudentController@edit');
Route::put('/student/update/{id}','StudentController@update');
Route::delete('/student/{id}','StudentController@destroy');
// BOOk
Route::get('/book','BookController@index');
Route::POST('/book/filter','BookController@filter');
Route::get('/book/filter','BookController@bookFilter');
Route::get('/book/create','BookController@create');
Route::post('/book/store','BookController@store');
Route::get('/book/{id}/edit','BookController@edit');
Route::put('/book/update/{id}','BookController@update');
Route::delete('/book/{id}','BookController@destroy');
// BOOKSHELF
Route::get('/bookshelf','BookshelfController@index');
Route::get('/bookshelf/create','BookshelfController@create');
Route::post('/bookshelf/store','BookshelfController@store');
Route::get('/bookshelf/{id}/edit','BookshelfController@edit');
Route::put('/bookshelf/update/{id}','BookshelfController@update');
Route::delete('/bookshelf/{id}','BookshelfController@destroy');
// BOOKISSUE
Route::get('/bookIssue','BookIssueController@index');
Route::get('/bookIssue/create','BookIssueController@create');
Route::post('/bookIssue/store','BookIssueController@store');
Route::get('/bookIssue/{id}/edit','BookIssueController@edit');
Route::put('/bookIssue/update/{id}','BookIssueController@update');
Route::delete('/bookIssue/{id}','BookIssueController@destroy');


//home
Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

});
