<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Subscribe;

class SubscribeController extends Controller
{
    // Подписка пользователя по email на рубрику
    public function subscribe(Request $request){
        //
    }
    // Удаление подписки по ID & Удаление на всё
    public function deleteSubscribe(Request $request){
        //
    }
    // Удаление подписки по ID & Удаление на всё
    public function deleteSubscribes(Request $request){
        //
    }
    // Отображение всех подписок пользователя
    public function subscriptionsUser(Request $request)
    {
        //
    }
    // Отображение всех подписанных пользователей у рубрики
    public function subscriptionsRubric(Request $request){
        //
        $subscribes = Subscribe::all();
        dd($subscribes);
    }
}
