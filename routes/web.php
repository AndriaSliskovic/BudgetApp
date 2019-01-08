<?php
Route::get('transactions/create','TransactionController@create');
//{category?} je opcioni parametar
Route::get('transactions/{category?}','TransactionController@index');
Route::get('transactions1/{category?}/{user?}','TransactionController@showByCategoryForAuthUser');

//Route::get('transactions/{category?}','TransactionController@showByCategory');
//Drugi nacin prethodnog
//Route::get('transactions/{category?}','TransactionController@showByCategory2');
Route::post('transactions','TransactionController@store');
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
