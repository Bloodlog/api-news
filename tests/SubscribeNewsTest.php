<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SubscribeNewsTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testSubscribeUser()
    {
        $this->post('api/v1/subscribe/1/user/fm@web-fomin.ru')
            ->seeJsonEquals([
                'status_code' => 200,
            ]);
    }
}
