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

Route::get('/', 'ParticipantController@index')->name('conference_form');

Route::post('/participants', 'ParticipantController@store');

Route::get('/participants', 'ParticipantController@list')->name('participants_list');

Route::get('/customers', 'ParticipantController@customers');