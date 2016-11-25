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
    // Инфо
    Route::get('/', 'Api\SubscribeController@index');

    // Подписка пользователя по email на рубрику
    Route::post('subscribe/{id}/user/{email}', 'Api\SubscribeController@subscribe');

    // Удаление подписки на рубрику по ID
    Route::delete('subscribe/{id}/user/{email}','Api\SubscribeController@deleteSubscribe');

    //Удаление всех подписок
    Route::delete('subscriptions/user/{email}','Api\SubscribeController@deleteSubscribes');
    // Только после авторизации

    // Отображение всех подписок пользователя
    Route::get('subscriptions/user/{email}',  'Api\SubscribeController@subscriptionsUser');
    //->middleware('auth:api');

    // Отображение всех подписанных пользователей у рубрики
    Route::get('subscriptions/rubric/{id}', 'Api\SubscribeController@subscriptionsRubric');
        //->middleware('auth:api');
});