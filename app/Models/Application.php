<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \Firebase\JWT\JWT;
use Illuminate\Support\Facades\Config;

class Application extends Model
{
    //
    /**
     * @return array(token_type, access_token)
     */
    public function generateAuthToken()
    {
        $secret_key = Config::get('app.secret_key');
        $jwt = JWT::encode([
            'iss' => 'api-news',
            'sub' => $this->key,
            'iat' => time(),
            'exp' => time() + (5 * 60 * 60),
        ], $secret_key);

        return $jwt;
    }
}
