<?php

$router->get('/', function () use ($router) {
    return $router->app->version();
});

/*
|-----------------------------------------------------------------------------------------------------------------------
| API Auth
|-----------------------------------------------------------------------------------------------------------------------
| App\Http\Controllers\Auth
| Como no se cree la necesidad de versionar la parte de autenticación de usuarios/rias, no se definen por ningún prefijo
| "vn", tan solo "auth".
|
*/

$router->group(['prefix' => 'auth', 'namespace' => 'Auth'], function () use ($router) {
    $router->post('register', 'RegisterController');
    $router->post('register-unverified', 'RegisterUnverifiedController');
    $router->get('verify/{token}', 'VerifyController');
    $router->post('login', 'LoginController');
    $router->get('logout', 'LogoutController');
});

/*
|-----------------------------------------------------------------------------------------------------------------------
| API v1
|-----------------------------------------------------------------------------------------------------------------------
| App\Http\Controllers\v1
|
*/

$router->group(['prefix' => 'v1', 'namespace' => 'v1'], function () use ($router) {
    //
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