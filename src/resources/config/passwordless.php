<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Passwordless Login
    |--------------------------------------------------------------------------
    |
    | The passwordless login service allows users to login by simply clicking a
    | link. This link is automatically registered as a REST endpoint.
    |
    | /wp-json/[namespace]/[route]
    |
    */

    'namespace' => 'passwordless',

    'route' => 'login',
];
