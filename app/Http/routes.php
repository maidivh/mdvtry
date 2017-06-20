<?php



Route::get('/', 'StaticPagesController@home');

Route::get('/help', 'StaticPagesController@help')->name('help');
Route::get('/about', 'StaticPagesController@about');

Route::get('/signup','UsersController@create')->name('signup');

Route::resource('users','UsersController');

/*resource 同等于下面*/

/*
Route::get('/users', 'UsersController@index')->name('users.index');
Route::get('/users/{user}', 'UsersController@show')->name('users.show');
Route::get('/users/create', 'UsersController@create')->name('users.create');
Route::post('/users', 'UsersController@store')->name('users.store');
Route::get('/users/{user}/edit', 'UsersController@edit')->name('users.edit');
Route::patch('/users/{user}', 'UsersController@update')->name('users.update');
Route::delete('/users/{user}', 'UsersController@destroy')->name('users.destroy');
*/

// 加载登录页面
Route::get('login','SessionsController@create')->name('login');

Route::post('login','SessionsController@store')->name('login');

Route::delete('logout','SessionsController@destroy')->name('logout');