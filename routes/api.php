<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Первая версия API подписки новостей
Route::group(['prefix' => 'v1'], function () {

    // Документация
    Route::get('/', ['uses' => 'Api\SubscribeController@index', 'as' => 'index']);

    // Подписка пользователя по email на рубрику по id
    Route::post('subscribe/{id}/user/{email}', ['uses' => 'Api\SubscribeController@subscribe', 'as' => 'subscribe'])
        ->where(['id' => '[0-9]+']);

    // Удаление подписки на рубрику по ID
    Route::delete('subscribe/{id}/user/{email}/', ['uses' => 'Api\SubscribeController@deleteSubscribe', 'as' => 'delete.subscribe'])
        ->where(['id' => '[0-9]+']);

    //Удаление всех подписок
    Route::delete('subscriptions/user/{email}', ['uses' => 'Api\SubscribeController@deleteSubscribes', 'as' => 'delete.subscribes'])
        ->where(['id' => '[0-9]+']);

    // Остальное только после авторизации

    // Отображение всех подписок пользователя
    Route::get('subscriptions/user/{email}', ['uses' => 'Api\SubscribeController@subscriptionsUser', 'as' => 'subscriptions.user'])
        ->where(['id' => '[0-9]+']);
    //->middleware('auth:api');

    // Отображение всех подписанных пользователей у рубрики
    Route::get('subscriptions/rubric/{id}', ['uses' => 'Api\SubscribeController@subscriptionsRubric', 'as' => 'subscriptions.rubric'])
        ->where(['id' => '[0-9]+']);
        //->middleware('auth:api');
});