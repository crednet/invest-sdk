<?php

use Illuminate\Support\Facades\Route;

Route::get('tenures', 'CPInvestController@getTenures');

Route::post('create', 'CPInvestController@create');

Route::get('all', 'CPInvestController@getAllUserInvestments');

Route::get('active', 'CPInvestController@getUserActiveInvestments');

Route::get('{investmentId}/details', 'CPInvestController@getInvestmentDetails');

Route::get(
    '{investmentId}/transactions',
    'CPInvestController@getInvestmentTransactions'
);

Route::post('otp', 'CPInvestController@requestOtp');

Route::post('{investmentId}/liquidate', 'CPInvestController@liquidateInvestment');

Route::post('{investmentId}/withdraw', 'CPInvestController@withdrawFunds');
