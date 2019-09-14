<?php


$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'contacts'], function ($router) {

    $router->get('/', 'ContactsController@index');
    $router->get('/{id}', 'ContactsController@findContact');
    $router->post('/', 'ContactsController@save');
    $router->patch('/{id}', 'ContactsController@update');
    $router->delete('/{id}', 'ContactsController@destroy');
});
