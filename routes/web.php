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
    $router->group(['prefix' => 'register'], function () use ($router) {
        $router->post('/', 'RegisterController');
        $router->post('unverified', 'RegisterUnverifiedController');
        $router->get('verify/{token}', 'RegisterVerifyController');
    });
    $router->post('login', 'LoginController');
    $router->group(['prefix' => 'password', 'namespace' => 'Password'], function () use ($router) {
        $router->post('forgotten', 'PasswordForgottenController');
        $router->get('verify/{token}', 'PasswordVerifyController');
        $router->put('reset', 'PasswordResetController');
    });
    $router->get('logout', 'LogoutController');
    $router->group(['prefix' => 'user', 'namespace' => 'UserProfile'], function () use ($router) {
        $router->get('/', 'UserController@show');
        $router->put('/', 'UserController@update');
        $router->delete('/', 'UserController@destroy');
    });
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