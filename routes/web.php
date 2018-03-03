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

Route::get('/', 'StaticPagesController@home')->name('home');

Route::get('help', 'StaticPagesController@help')->name('help');

Route::get('about', 'StaticPagesController@about')->name('about');

Route::get('signup', 'UsersController@create')->name('signup');

Route::resource('users', 'UsersController');
//显示账户登录界面
Route::get('login', 'SessionsController@create')->name('login');
//账户登录操作
Route::post('login', 'SessionsController@store')->name('login');
//账户退出操作
Route::delete('logout', 'SessionsController@destroy')->name('logout');
//激活账户操作
Route::get('signup/confirm/{token}', 'UsersController@confirmEmail')->name('confirm_email');
//显示重置密码邮件发送页面
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
//发送重置密码链接
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
//显示重置密码设置页面
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
//更新密码操作
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');
