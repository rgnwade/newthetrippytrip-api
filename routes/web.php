<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});
  $router->get('homepage', array('uses' => 'PageController@homepage'));
  $router->get('food-drink', array('uses' => 'PageController@food_drink'));
  $router->get('nightlife', array('uses' => 'PageController@nightlife'));
  $router->get('lifestyle', array('uses' => 'PageController@lifestyle'));
  $router->get('fashion', array('uses' => 'PageController@fashion'));
  $router->get('culture', array('uses' => 'PageController@culture'));
  $router->get('resource', array('uses' => 'PageController@resource'));
  $router->get('chill', array('uses' => 'PageController@chill'));

$router->group(array('prefix' => 'user'), function () use ($router) {
    $router->post('register', array('uses' => 'Auth\UserController@register'));
    $router->post('login', array('uses' => 'Auth\UserController@login'));
    $router->post('get-profile', array('uses' => 'Auth\UserController@getProfile'));
    $router->post('activation', array('uses' => 'Auth\UserController@activationAccount'));
    $router->get('all-user', array('uses' => 'Auth\UserController@getAllUser'));
    $router->post('subscribe', array('uses' => 'Auth\UserController@subscribe'));
    $router->get('all-subscribe', array('uses' => 'Auth\UserController@getAllSubscribe'));
});

$router->group(array('prefix' => 'article'), function () use ($router) {
    $router->get('all-category', array('uses' => 'Article\CategoryController@getAllCategory'));
    $router->get('parent-category', array('uses' => 'Article\CategoryController@getParentCategory'));
    $router->get('child-category', array('uses' => 'Article\CategoryController@getChildCategory'));
    $router->get('countries', array('uses' => 'Location\LocationController@getCountries'));
    $router->get('location', array('uses' => 'Location\LocationController@getLocation'));
    $router->get('region', array('uses' => 'Location\LocationController@getRegion'));
    $router->post('post-article', array('uses' => 'Article\ArticleController@postArticle'));
    $router->put('update-article/{id}', array('uses' => 'Article\ArticleController@updateArticle'));
    $router->delete('delete-article/{id}', array('uses' => 'Article\ArticleController@destroy'));
    $router->get('get-article', array('uses' => 'Article\ArticleController@getArticle'));
    $router->get('get-article-homepage', array('uses' => 'Article\ArticleController@getArticleHomepage'));
    $router->get('get-article-page', array('uses' => 'Article\ArticleController@getArticlePage'));
    $router->get('get-article-by-id/{id}', array('uses' => 'Article\ArticleController@getArticleById'));
    $router->post('post-media', array('uses' => 'Article\ArticleController@postMedia'));
    $router->get('get-media', array('uses' => 'Article\ArticleController@getMedia'));
});

$router->group(array('prefix' => 'admin'), function () use ($router) {
    $router->get('roles', array('uses' => 'Admin\AccountController@Roles'));
    $router->post('register-admin', array('uses' => 'Admin\AccountController@registerAdmin'));
    $router->post('login-admin', array('uses' => 'Admin\AccountController@loginAdmin'));
    $router->post('register-client', array('uses' => 'Admin\AccountController@registerClient'));
    $router->get('all-admin', array('uses' => 'Admin\AccountController@getAllAdmin'));
    $router->get('all-client', array('uses' => 'Admin\AccountController@getAllClient'));
    $router->post('add-contract', array('uses' => 'Article\ArticleController@addContract'));
    $router->get('get-contract', array('uses' => 'Article\ArticleController@getContract'));
    $router->get('get-author', array('uses' => 'Admin\AccountController@getAuthor'));
});
