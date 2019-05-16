<?php

Route::get('/', function (\Illuminate\Http\Request $request) {
    $user = $request->user();

    dump($user->hasRole('admin', 'user'));
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
