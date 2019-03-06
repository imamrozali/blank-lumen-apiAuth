<?php

$router->get('/', function () use ($router) {
    return $router->app->version();
});

/*
|-----------------------------------------------------------------------------------------------------------------------
| API v1
|-----------------------------------------------------------------------------------------------------------------------
| App\Http\Controllers\v1
|
*/

$router->group(['prefix' => 'v1', 'namespace' => 'v1'], function () use ($router) {
    $router->group(['prefix' => 'auth', 'namespace' => 'Auth'], function () use ($router) {
        $router->post('register', 'RegisterController');
        $router->get('verify-account/{token}', 'VerifyAccountController');
    });
});


/*
|--------------------------------------------------------------------------
| API v2
|--------------------------------------------------------------------------
| App\Http\Controllers\v2
|
*/

$router->group(['prefix' => 'v2', 'namespace' => 'v2'], function () use ($router) {
    //
});