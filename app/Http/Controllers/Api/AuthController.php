<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    /**
     * Авторизация приложения
     * @param Request $request
     * @return string
     */
    public function authenticateApp(Request $request){
        return \Request::header('Authorization') ? 'yes' : 'no';
    }
}
