<?php

use Illuminate\Support\Facades\Route;


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

Route::get('/', function () {
    return view('home');
});

Route::get('/regulation', function () {
    return view('regulation');
});

Route::get('/manage/admin', function () {
    return view('connectadmin');
});

Route::post('/api/insertAlivePlayers', 'gameController@insertAlivePlayer'); //Request to connect admin

Route::post('/api/killPlayersNotPlays', 'gameController@updateNoPlayGamer'); //Request to connect admin


Route::get('/user/admin-dashboard-safe/', 'adminController@adminDash'); //Request to creat new account


Route::post('/api/adminlogin', 'adminController@admin'); //Request to connect admin


Route::post('/api/new-account', 'userController@newUser'); //Request to creat new account

Route::post('/api/old-account', 'userController@oldUser'); //Request to connect old account

Route::get('/user/game-dashboard/', 'dashboardController@openDashboard'); //Request to creat new account

Route::post('/api/getAdmin', 'adminController@getTime'); //Request to retur dashboainfo to admin


Route::post('/api/get-remain-time', 'dashboardController@getTime'); //Request to retur dashboad
Route::post('/api/update-game-status', 'dashboardController@updateGame'); //RMettre le pointeur sur le jeu suivant
Route::post('/api/checkAnswer', 'dashboardController@checkAnswer'); //Checker la reponse 
Route::post('/api/check-player-number', 'userController@checkLiveNumber'); //Recuperer le nombre d'inscrit 

Route::post('/api/get-dead-gamer', 'dashboardController@getDeadPlayer'); //get dead gamer number 
Route::post('/api/checkIfAnswer', 'dashboardController@ifAnswer');

Route::fallback(function() {
    return view('404error'); // la vue 404error.blade.php
 });