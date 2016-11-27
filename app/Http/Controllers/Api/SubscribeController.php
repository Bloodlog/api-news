<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use Response;
use App\Http\Controllers\Controller;
use App\Models\Subscribe;
use App\Models\Subscription;
use App\Models\Rubric;

class SubscribeController extends Controller
{
    /**
     * Подписка пользователя по email на id рубрику
     *
     * @param $id
     * @param $email
     *
     * @return Response
     *
     * @Rest\Post("subscribe/{id}/user/{email}")
     */
    public function subscribe($id, $email){
        //
        $rubric = Rubric::find($id);
        // Проверка есть ли email  таблице
        $subscribe = Subscribe::firstOrCreate(array('email' => $email));
        //Удаляем свзяь
        $rubric->subscribes()->detach($subscribe->id);
        //Добавляем связь
        $rubric->subscribes()->attach($subscribe->id);
        $status_code = 200;
        return Response::json(array(
            'status_code' => $status_code,
        ));
    }

    /**
     * Удаление подписки по ID & email
     *
     * @param $id
     * @param $email
     *
     * @return Response
     */
    public function deleteSubscribe($id, $email){
        $rubric = Rubric::find($id);
        // Проверка есть ли email  таблице
        $subscribe = Subscribe::firstOrCreate(array('email' => $email));
        //Удаляем свзяь
        $rubric->subscribes()->detach($subscribe->id);
        $status_code = 200;
        return Response::json(array(
            'status_code' => $status_code,
        ));
    }

    /**
     * Удаление всех подписок по email
     *
     * @param $email
     *
     * @return Response
     */
    public function deleteSubscribes($email){
        $subscribe = Subscribe::firstOrCreate(array('email' => $email));
        // Передаём атрибут id подписчика для удаления
        $subscribe->rubrics()->detach(['subscribe_id' => $subscribe->id]);
        $status_code = 200;
        return Response::json(array(
            'status_code' => $status_code,
        ));
    }

    /**
     * Отображение всех подписок пользователя
     *
     * @param Request $request
     * @param $email
     * @throws UnauthorizedHttpException
     *
     * @return Response
     */
    public function subscriptionsUser(Request $request, $email)
    {
        ///dogs?limit=25&offset=50
        $limit = $request->limit;
        $offset = $request->offset;
    }

    /**
     * Отображение всех подписанных пользователей у рубрики
     *
     * @param Request $request
     * @param $id
     * @throws UnauthorizedHttpException
     *
     * @return Response
     */
    public function subscriptionsRubric(Request $request, $id){
        ///dogs?limit=25&offset=50
        $subscribes = Subscribe::all();
        dd($subscribes);
    }

    // Документация
    public function index(){
        return '
            Документация API news v1<br>
            // Подписка пользователя по email на рубрику<br>
            subscribe/{id}/user/{email}<br>
            // Удаление подписки на рубрику по ID<br>
            subscribe/{id}/user/{email}<br>
            //Удаление всех подписок<br>
            subscriptions/user/{email}<br>
            // Только после авторизации<br>
            // Отображение всех подписок пользователя<br>
            subscriptions/user/{email}<br>
            // Отображение всех подписанных пользователей у рубрики<br>
            subscriptions/rubric/{id}<br>
        ';
    }

}
