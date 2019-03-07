<?php

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('/email', function () use ($router) {
    return view('emails.auth.verify-account');
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
        $router->post('register-unverified', 'RegisterUnverifiedController');
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