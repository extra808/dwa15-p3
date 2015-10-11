<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('home')-> withSitetitle('Developer\'s Best Friend');
});

Route::get('p3-logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');

Route::get('/lorem', 'LoremController@getLorem');