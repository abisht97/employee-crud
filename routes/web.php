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

Route::get('/', 'HomeController@index')->name('index');

Route::get('employee/create', 'EmployeeController@create')->name('employee.create');
Route::post('employee/store', 'EmployeeController@store')->name('employee.store');
Route::get('employee/{id}', 'EmployeeController@show')->name('employee.show')->middleware('signed');
Route::put('employee/{id}/update', 'EmployeeController@update')->name('employee.update');
Route::delete('employee/{id}', 'EmployeeController@destroy')->name('employee.destroy');

Route::resource('role', 'RoleController');