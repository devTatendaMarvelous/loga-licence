<?php
return [
    'is_licenced' => env('APP_IS_LICENCED', false),
    'licence_app_url' => env('LICENCE_APP_URL'),
    'app_type' => env('LICENCE_APP_TYPE', 'single'),
    'licence_type' => env('LICENCE_TYPE', 'api'),
    'app_ref'=>env('LICENCE_APP_REF', ''),
];
