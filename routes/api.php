<?php

use Illuminate\Support\Facades\Route;

Route::get('tenures', 'CPInvestController@getTenures');

Route::get('investment-types', 'CPInvestController@getInvestmentTypes');
Route::get('investment-types/{investmentTypeSlug}', 'CPInvestController@getInvestmentTypeDetails');
Route::post('rate/percentage', 'CPInvestController@getRate');

Route::post('create', 'CPInvestController@create');

Route::get('all', 'CPInvestController@getAllUserInvestments');

Route::get('active', 'CPInvestController@getUserActiveInvestments');
Route::get('history', 'CPInvestController@getInvestmentHistory');
Route::get('{investmentId}/details', 'CPInvestController@getInvestmentDetails');
Route::get('active-investment-summary', 'CPInvestController@activeInvestmentSummary');
Route::get(
    '{investmentId}/transactions',
    'CPInvestController@getInvestmentTransactions'
);

Route::post('otp', 'CPInvestController@requestOtp');

Route::post('{investmentId}/liquidate', 'CPInvestController@liquidateInvestment');

Route::post('{investmentId}/withdraw', 'CPInvestController@withdrawFunds');

/** ========== Admin Expense Route ========= **/
Route::group([
    'namespace' => 'Admin',
    'prefix' => 'admin',
    'middleware' => ['auth:api']
], function () {
    Route::get('rates', 'CPInvestController@getRates');

    Route::get('investments', 'CPInvestController@getAllInvestments');
});


Route::post('webhook', 'CPInvestController@webhook')->withoutMiddleware('auth:api');
