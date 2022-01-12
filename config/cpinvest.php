<?php

return [
    'base_url' => env('CPINVEST_BASEURL', 'https://localhost:8000/api/'),
    'client_key' => env('CPINVEST_CLIENT_KEY'),
    'prefix' => 'api/invest',
    'middleware' => ['api'],
];
