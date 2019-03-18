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
    $router->post('login', 'LoginController');
    $router->get('logout', 'LogoutController');
    $router->group(['prefix' => 'register'], function () use ($router) {
        $router->post('/', 'RegisterController');
        $router->post('unverified', 'RegisterUnverifiedController');
        $router->get('verify/{token}', 'RegisterVerifyController');
    });
    $router->group(['prefix' => 'password', 'namespace' => 'Password'], function () use ($router) {
        $router->post('forgotten', 'PasswordForgottenController');
        $router->get('verify/{token}', 'PasswordVerifyController');
        $router->put('reset', 'PasswordResetController');
    });
    $router->group(['prefix' => 'user', 'namespace' => 'UserProfile'], function () use ($router) {
        $router->get('/', 'UserController@show');
        $router->put('/', 'UserController@update');
        $router->delete('/', 'UserController@destroy');
        $router->group(['prefix' => 'email'], function () use ($router) {
            $router->get('/', 'UserEmailController@show');
            $router->put('/', 'UserEmailController@update');
            $router->get('two', 'UserEmailTwoController@show');
            $router->put('two', 'UserEmailTwoController@update');
            $router->delete('two', 'UserEmailTwoController@destroy');
            $router->get('verify/{token}', 'UserEmailVerifyController@show');
        });
        $router->group(['prefix' => 'name'], function () use ($router) {
            $router->get('/', 'UserNameController@show');
            $router->put('/', 'UserNameController@update');
            $router->delete('/', 'UserNameController@destroy');
        });
        $router->group(['prefix' => 'phone'], function () use ($router) {
            $router->get('/', 'UserPhoneController@show');
            $router->put('/', 'UserPhoneController@update');
            $router->delete('/', 'UserPhoneController@destroy');
        });
        $router->put('password', 'UserPasswordController');
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