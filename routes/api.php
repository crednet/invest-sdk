<?php

use Credpal\CPInvest\Http\Controllers\CPInvestController;
use Illuminate\Support\Facades\Route;

Route::get('tenures', 'Credpal\CPInvest\Http\Controllers\CPInvestController@getTenures')
    ->middleware('auth:api');

Route::post('create', 'Credpal\CPInvest\Http\Controllers\CPInvestController@create')
    ->middleware('auth:api');

Route::get('all', 'Credpal\CPInvest\Http\Controllers\CPInvestController@getAllUserInvestments')
    ->middleware('auth:api');

Route::get('active', 'Credpal\CPInvest\Http\Controllers\CPInvestController@getUserActiveInvestments')
    ->middleware('auth:api');

Route::get('{investmentId}/details', 'Credpal\CPInvest\Http\Controllers\CPInvestController@getInvestmentDetails')
    ->middleware('auth:api');

Route::get(
    '{investmentId}/transactions',
    'Credpal\CPInvest\Http\Controllers\CPInvestController@getInvestmentTransactions'
)->middleware('auth:api');

Route::post('{investmentId}/liquidate', 'Credpal\CPInvest\Http\Controllers\CPInvestController@liquidateInvestment')
    ->middleware('auth:api');

Route::post('{investmentId}/withdraw', 'Credpal\CPInvest\Http\Controllers\CPInvestController@withdrawFunds')
    ->middleware('auth:api');
