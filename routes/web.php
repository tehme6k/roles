<?php

Route::get('/', function (\Illuminate\Http\Request $request) {
    $user = $request->user();

    dump($user->can('delete users'));
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
