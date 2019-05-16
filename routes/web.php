<?php

Route::get('/', function (\Illuminate\Http\Request $request) {
    $user = $request->user();

    dump($user->can('delete post'));
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
