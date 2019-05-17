<?php

Route::get('/', function (\Illuminate\Http\Request $request) {
    $user = $request->user();

    $user->updatePermissions(['delete post']);

    return new \Illuminate\Http\Response('hello', 200);
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
