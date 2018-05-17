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

Route::get('/', 'HomeController@index')->name('home');



Route::group(['middleware' => 'admin'], function() {
    Route::get('/administration','AdminController@admin')->name('admin');

    Route::get('/administration/liste-des-utilisateurs','AdminController@getUsers');

    Route::get('/administration/dU/{id}','AdminController@deleteUsers');
    Route::get('/administration/rU/{id}','AdminController@reactivateUsers');
    Route::get('/administration/annuler-abonnement/{id}/{user_id}','AdminController@cancelSubscription');
    Route::get('/administration/liste-des-utilisateurs/{page}','AdminController@getUsers');
    Route::get('/administration/liste-des-utilisateurs-supprimes','AdminController@getUsersDeleted');
    Route::get('/administration/liste-des-utilisateurs-supprimes/{page}','AdminController@getUsersDeleted');


    Route::get('/administration/liste-des-utilisateurs-abonnes','AdminController@getSubscribers');
    Route::get('/administration/liste-des-utilisateurs-abonnes/{page}','AdminController@getSubscribers');

    Route::post('/administration','AdminController@admin');


    Route::get('/administration/ajouter-un-site', 'SitesController@create');
    Route::post('/administration/ajouter-un-site', 'SitesController@store');


    Route::get('/administration/ajouter-un-service', 'ServicesController@create');
    Route::post('/administration/ajouter-un-service', 'ServicesController@store');
    Route::get('/getServices', 'ServicesController@getServices');


    Route::get('/administration/ajouter-un-equipement', 'EquipementsController@create');
    Route::post('/administration/ajouter-un-equipement', 'EquipementsController@store');
    Route::get('/getEquipements', 'EquipementsController@getEquipements');


    Route::post('/administration/getSpaces', 'SitesController@getSpaces');


    Route::get('/administration/abonnements','AdminController@subcriptions');
    Route::get('/administration/reservations','AdminController@reservations');
    Route::get('/administration/locations','AdminController@loans');

});



Route::post('/inscription', 'RegistrationController@store');
Route::get('/inscription', 'RegistrationController@create');
Route::get('/activer-le-compte', 'RegistrationController@activateLink');
Route::get('/activation/{token}', 'RegistrationController@activate');

Route::get('/connexion', 'SessionsController@create');
Route::post('/connexion', 'SessionsController@store');
Route::get('/logout', 'SessionsController@destroy');

Route::get('/mot-de-passe/email', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('/mot-de-passe/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.request');

Route::get('/mot-de-passe/reinitialisation/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('/mot-de-passe/reinitialisation', 'Auth\ResetPasswordController@reset');






Route::group(['middleware' => 'auth'], function () {

    Route::get('/mot-de-passe/{token}', 'SessionsController@passwordRequest');

    Route::get('/pdf','PDFController@getReceipt');


    Route::get('/editer-mes-informations','UserController@edit');


    Route::get('/sabonner', 'SubscriptionsController@getAll');
    Route::get('/sabonner/{offer}', 'SubscriptionsController@show');
    Route::get('/sabonner/{offer}/{engagement}', 'SubscriptionsController@show');
    Route::post('/sabonner', 'SubscriptionsController@subscribe');
    Route::get('/abonnement', 'SubscriptionsController@showClient');

});





Route::group(['middleware' => 'subscriber'], function () {
    Route::post('/reserver-un-espace', 'ReservationsController@store');
    Route::get('/reserver-un-espace', 'ReservationsController@reserve');
    Route::get('/annuler-reservation/{token}', 'ReservationsController@cancel');


    Route::post('/commander-un-plateau-repas', 'ReservationsController@storePlateau');
    Route::get('/commander-un-plateau-repas', 'ReservationsController@reservePlateau');
    Route::get('/annuler-un-plateau-repas/{token}', 'ReservationsController@cancelPlateau');


    Route::get('/getSpaces', 'ReservationsController@getSpaces');
    Route::get('/getHours', 'ReservationsController@getHours');

    Route::get('/changer-d-offre/{token}','SubscriptionsController@change');
    Route::post('/changer-offre/{token}','SubscriptionsController@storeNewOffer');
    Route::get('/changer-offre/{token}/{offer}','SubscriptionsController@changeOffer');
    Route::get('/changer-offre/{token}/{offer}/{engagement}','SubscriptionsController@changeOffer');

    Route::get('/desabonnement/{token}', 'SubscriptionsController@cancelPage');
    Route::post('/desabonnement/{token}', 'SubscriptionsController@cancel');


    Route::get('/louer-un-equipement', 'EquipementsLoansController@create');
    Route::post('/louer-un-equipement', 'EquipementsLoansController@store');
    Route::get('/annuler-location', 'EquipementsLoansController@cancel');
    Route::get('/getEquipementsBySites', 'EquipementsLoansController@getEquipementsBySites');


    Route::get('/mes-reservations', 'ReservationsController@showAll');


    Route::get('/facture', 'PDFController@getReceipt');


});




