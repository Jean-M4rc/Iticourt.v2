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

Route::view('/', 'home');

Route::view('/about', 'about');

Route::get('/inscription', 'InscriptionController@formulaire');

Route::post('/inscriptionVendeur', 'InscriptionController@traitementVendeur');

Route::post('/inscriptionAcheteur', 'InscriptionController@traitementAcheteur');

Route::post('/connexion', 'ConnexionController@traitement');

Route::get('/sellersList', 'SellerListController@sellersList');

Route::get('/sellersMarkersGet', 'SellerListController@sellersMarkers');

Route::get('/sellerFile{id}', 'SellerListController@sellerFile');

Route::group(['middleware' => 'App\Http\Middleware\Auth'], function () {

    Route::get('/rootme', 'RootController@administration');

    Route::post('/banUser', 'RootController@bannissement');

    Route::post('/resetSellerAvatar', 'RootController@resetAvatar');

    Route::post('/deleteSeller', 'RootController@deleteSeller');

    Route::post('/moderateComment', 'CommentsController@moderateComment');

    Route::post('/deleteComment', 'CommentsController@deleteComment');

    Route::get('/profil', 'CompteController@accueil');

    Route::post('/updateUser', 'UpdateController@updateUser');

    Route::post('/updateSeller', 'UpdateController@updateSeller');

    Route::post('/comments', 'CommentsController@store');

    Route::get('/deconnexion', 'CompteController@deconnexion');

    Route::post('/deleteMyAccount', 'CompteController@deleteMyAccount');

    Route::post('/deleteMyShop', 'CompteController@deleteMyShop');

});
