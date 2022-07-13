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

Route::get('/login', 'LoginController@login')->name('login');
Route::post('/login', 'LoginController@loginPost')->name('login-post');
Route::get('/logout', 'LoginController@logout')->name('logout');

Route::get('/subscribe', 'UserController@subscribe')->name('subscribe');
Route::post('/subscribe', 'UserController@subscribePost')->name('subscribe-post');


Route::middleware('login')->prefix('')->group(function(){
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/show/{id}', 'HomeController@show')->name('show');
    Route::get('/new-contact', 'HomeController@newContact')->name('new-contact');
    Route::post('/new-contact', 'HomeController@newContactPost')->name('new-contact-post');
    Route::get('/edit-contact/{id}', 'HomeController@editContact')->name('edit-contact');
    Route::post('/edit-contact/{id}', 'HomeController@editContactPost')->name('edit-contact-post');
    Route::get('/delete/{id}', 'HomeController@delete')->name('delete');
    
    Route::get('/profile/{id}', 'UserController@profile')->name('profile');
    Route::post('/profile/{id}', 'UserController@profilePost')->name('profile-post');
});
