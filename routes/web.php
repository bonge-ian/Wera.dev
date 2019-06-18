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

Route::get('/', 'JobsController@index');

// auth routes
Auth::routes();

// dashboard
Route::get('/home', 'HomeController@index')->name('dashboard');

Route::prefix('jobs')->name('jobs.')->group(function () {
    Route::middleware('auth')->group(function () {
        Route::get('/create', 'JobsController@create')->name('create');
        Route::post('/create', 'JobsController@store')->name('create.submit');
      
        Route::get('/{job}/edit', 'JobsController@edit')->name('edit');
        Route::patch('/{job}/update', 'JobsController@update')->name('update');

        Route::delete('/{job}/del', 'JobsController@destroy')->name('destroy');

        Route::get('/{job}/apply', 'ApplyController@index')->name('apply');
        Route::post('/{job}/apply', 'ApplyController@store')->name('apply.submit');

        Route::get('/markAsRead', function () {
            auth()->user()->unreadNotifications->markAsRead();

            return back();
        })->name('markAsRead');

            
        Route::get('/view-application/{application}', 'ApplyController@viewApplication')->name('viewApp');
    });

   

    Route::get('/cat', 'JobsController@jobByCategory')->name('cat');
    Route::get('/{job}', 'JobsController@show')->name('view');

    Route::get('/download/{job}/{name}', 'ApplyController@download')->name('download');

    // index
    Route::get('/', 'JobsController@index')->name('index');


});
