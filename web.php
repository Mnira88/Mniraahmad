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
    return view('login.login');
});


Route::post('/login','AuthController@login')->name('login');
Route::post('/register/manager','AuthController@managerRegister')->name('register.manager');
Route::post('/register/patient','AuthController@visitor_register')->name('register.patient');
Route::get('/loginpage', 'AuthController@loginpage')->name('login.show');
Route::get('/activate', 'AuthController@activatepage')->name('activate.show');
Route::get('/manager/register', 'AuthController@managerRegisternpage')->name('manager.registerPage');
Route::get('/visitor/register', 'AuthController@visitorRegisternpage')->name('visitor.registerPage');
Route::get('/password/forget', 'AuthController@forgetpage')->name('password.forget');
Route::any('/password/reset', 'AuthController@newpassword')->name('password.new');
Route::any('/account/verify', 'AuthController@verify')->name('account.activate');


Route::get('/logout/{type}', 'AuthController@logout')->name('logout');
Route::get('/dashboard', 'AuthController@dashboard')->name('dashboard');

Route::get('/admin/dashboard', 'AdminController@dashboard')->name('admin.dashboard');
Route::get('/manager/dashboard', 'ManagerController@dashboard')->name('manager.dashboard');
Route::get('/visitor/dashboard', 'VisitorController@dashboard')->name('visitor.dashboard');

Route::get('/admin/profile/{id}', 'AdminController@profile')->name('admin.profile');
Route::get('/manager/profile/{id}', 'ManagerController@profile')->name('manager.profile');
Route::get('/visitor/profile/{id}', 'VisitorController@profile')->name('visitor.profile');

Route::resource('admins','AdminController');
Route::resource('managers','ManagerController');
Route::resource('visitors','VisitorController');
Route::resource('posts','PostController');
Route::resource('emotions','EmotionController');


Route::get('/visitor/posts/new', 'PostController@newbyVisitor')->name('visitor.newposts');
Route::get('/visitor/posts/old', 'PostController@oldbyVisitor')->name('visitor.oldposts');

Route::get('/post/new', 'PostController@newByManager')->name('manager.newposts');
Route::get('/post/old', 'PostController@oldByManager')->name('manager.oldposts');
