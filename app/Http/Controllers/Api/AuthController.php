<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Application;

class AuthController extends Controller
{
    /**
     * Авторизация приложения
     * @param Request $request
     * @return string
     */
    public function authenticateApp(Request $request){
        $credentials = base64_decode(
            substr($request->header('Authorization'), 6)
        );

        try {
            list($appKey, $appSecret) = explode(':', $credentials);

            $app = Application::whereKeyAndSecret($appKey, $appSecret)->firstOrFail();
        } catch (\Throwable $e) {
            return response('invalid_credentials', 400);
        }

        if (! $app->is_active) {
            return response('app_inactive', 403);
        }

        return response([
            'token_type' => 'Bearer',
            'access_token' => $app->generateAuthToken(),
        ]);
    }
    public function appData(Request $request)
    {
        return $request->__authenticatedApp;
    }
}
