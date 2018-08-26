<?php

Route::get('/', 'DashboardController@index')->name('home');
Route::get('/register', 'RegistrationController@showRegistrationForm')->name('register');
Route::post('/register', 'RegistrationController@register')->name('register');
Route::get('/login', 'LoginController@showLoginForm')->name('login');
Route::post('/login', 'LoginController@login')->name('login');
Route::post('/logout', 'LoginController@logout')->name('logout');
