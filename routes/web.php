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

Route::get('/', function () {
     return redirect('/login');
});

Auth::routes();
Route::any('/logout', 'Auth\LoginController@logout')->name('logout');
Route::any('/home', 'HomeController@index')->name('home');

//Employees

Route::any('/add_employees', 'HomeController@add_employees');
Route::any('/update_employees', 'HomeController@get_employee');
Route::any('/del_employee', 'HomeController@del_employee');
Route::any('/act_employee', 'HomeController@activate_employee');
Route::any('/get_rate', 'HomeController@get_rate');
Route::any('/check_code', 'HomeController@check_code');
