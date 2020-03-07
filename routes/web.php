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

// Route::get('/', function () {
//     return view('home');
// });
Route::get('/','HomeController@index');
Route::post ('/search','HomeController@search');

Route::post('/search/load_content', 'HomeController@search')->name('search.content');
Route::post('import', 'HomeController@import')->name('import');
Route::post('getheader', 'HomeController@getHeaderRow')->name('getheader');

// Admin routes
Route::post("/admin/login", "Auth\LoginController@login");
Route::get('/admin', 'Admin\AdminController@showAdminLoginForm');
Route::post('/admin', 'Auth\LoginController@login');

Route::get('/admin/register', 'Admin\AdminController@showAdminRegistrationForm');
Route::post('/admin/register', 'Auth\RegisterController@register');

Route::group(['middleware' => 'auth'], function () { 
    
    Route::get('/admin/logout', 'Admin\AdminController@logout');
    Route::get("/admin/home", 'Admin\HomeController@index');//
  
      //admin user role
    Route::resource('admin/roles', 'Admin\RoleController');
    Route::get('admin/roles/delete/{id}', 'Admin\RoleController@destroy');
  
    Route::resource('admin/users', 'Admin\UserController');
    Route::get('admin/users/delete/{id}', 'Admin\UserController@destroy');
    Route::post('admin/users/setactive', 'Admin\UserController@setactive');
  
  });