<?php

return [
    'base_url' => env('CPINVEST_BASEURL', 'https://localhost:8000/api/'),
    'client_key' => env('CPINVEST_CLIENT_KEY'),
    'credpal_cash_table' => env('CPINVEST_CASH_TABLE', 'cpcash_wallets'),
    'prefix' => 'api/invest',
    'middleware' => ['api', 'auth:api'],
    'namespace' => 'Credpal\CPInvest\Http\Controllers',
];
