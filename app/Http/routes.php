<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::filter('csrf', function() {
    $token = Request::ajax() ? Request::header('X-CSRF-Token') : Input::get('_token');
    if (Session::token() != $token)
        throw new Illuminate\Session\TokenMismatchException;
});

Route::get('/', 'HomeController@index');
Route::get('dashboard', 'DashboardController@index');
Route::get('/dashboard/donated', 'DashboardController@donated');
Route::get('/dashboard/brokered', 'DashboardController@brokered');
Route::get('/dashboard/organizationData', 'DashboardController@organizationData');

/* Modal Box Start*/
Route::get('/dashboard/buy', 'DashboardController@buy');
Route::get('/dashboard/sell', 'DashboardController@sell');
Route::get('/dashboard/transfer', 'DashboardController@transfer');
Route::get('/dashboard/grant', 'DashboardController@grant');
Route::get('/dashboard/park', 'DashboardController@park');

Route::get('/dashboard/pvdata', 'DashboardController@pvdata');
Route::get('/dashboard/pvDataGrid', 'DashboardController@pvDataGrid');

Route::get('/dashboard/orgData', 'DashboardController@orgData');
Route::get('/dashboard/organizationDataGrid', 'DashboardController@organizationDataGrid');
/* Modal Box End*/

Route::get('/dashboard/member', 'DashboardController@member');
Route::get('/dashboard/stats', 'DashboardController@stats');
Route::get('/dashboard/carbonCredit', 'DashboardController@carbonCredit');

Route::post('/dashboard/organization', 'DashboardController@organization');
Route::post('/dashboard/programme', 'DashboardController@programme');
Route::post('/dashboard/project', 'DashboardController@project');

Route::post('/dashboard/addTransactions', 'DashboardController@addTransactions');
Route::post('/dashboard/addPvData', 'DashboardController@addPvData');

Route::post('/dashboard/addOrganization', 'DashboardController@addOrganization');

Route::controllers([
	'user' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);