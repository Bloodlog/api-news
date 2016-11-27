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
     * @param $rubric_id
     * @param $email
     *
     * @return Response
     *
     * @Rest\Post("subscribe/{id}/user/{email}")
     */
    public function subscribe($rubric_id, $email){
        //
        $rubric = Rubric::find($rubric_id);
        // Проверка есть ли email  таблице
        $subscribe = Subscribe::firstOrCreate(array('email' => $email));
        //Удаляем свзяь
        $rubric->subscribes()->detach( $subscribe->id );
        //Добавляем связь
        $rubric->subscribes()->attach( $subscribe->id );
        $status_code = 200;
        return Response::json(array(
            'status_code' => $status_code,
        ));
    }

    /**
     * Удаление подписки по ID & email
     *
     * @param $rubric_id
     * @param $email
     *
     * @return Response
     * @Rest\Delete("subscribe/{rubric_id}/user/{email}")
     */
    public function deleteSubscribe($rubric_id, $email){
        $rubric = Rubric::find($rubric_id);
        // Проверка есть ли email  таблице
        $subscribe = Subscribe::firstOrCreate(array('email' => $email));
        //Удаляем свзяь
        $rubric->subscribes()->detach( $subscribe->id );
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
     * @Rest\Delete("subscriptions/user/{email}")
     */
    public function deleteSubscribes($email){
        $subscribe = Subscribe::firstOrCreate(array('email' => $email));
        $subscribe->rubrics()->detach();
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
     * @return Response json
     * @Rest\Get("subscriptions/user/{email}")
     */
    public function subscriptionsUser(Request $request, $email)
    {
        // Request параметр limit - ограничивающий выдачу
        $limit = ((int)$request->limit)? : 5;
        $offset = ((int)$request->offset)? : null;
        $email = 'fm@web-fomin.ru';
        $subscriptions = Subscribe::firstOrCreate(array('email' => $email));
        $rubrics = $subscriptions->rubrics()->where('subscribe_id', $subscriptions->id)->paginate($limit, ['*'], 'offset', $offset);
        $rubricsArray = $rubrics->toArray();
        // Извлекаем последний элемент pivot
        foreach ($rubricsArray["data"] as $key => $value){
            array_pop($rubricsArray["data"][$key]);
        }

        $status_code = 200;
        $response = [
            'status_code' => $status_code,
            'data'   => $rubricsArray["data"],
            'pagination' => [
                'total'         => $rubricsArray['total'],
                'per_page'      => $rubricsArray['per_page'],
                'current_page'  => $rubricsArray['current_page'],
                'last_page'     => $rubricsArray['last_page'],
                'next_page_url' =>
                    $rubricsArray['next_page_url'] .= ($rubricsArray['next_page_url'])? '&limit=' . $limit : null,
                'prev_page_url' =>
                    $rubricsArray['prev_page_url'] .= ($rubricsArray['prev_page_url'])? '&limit=' . $limit : null,
            ]
        ];
        return Response::json($response);
    }

    /**
     * Отображение всех подписанных пользователей у рубрики
     *
     * @param Request $request
     * @param $rubric_id
     * @throws UnauthorizedHttpException
     *
     * @return Response Json
     * @Rest\Get("subscriptions/rubric/{rubric_id}")
     */
    public function subscriptionsRubric(Request $request, $rubric_id){
        ///dogs?limit=25&offset=50
        $subscribes = Subscribe::all();
        dd($subscribes);
        $status_code = 200;
        return Response::json(array(
            'status_code' => $status_code,
        ));
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
