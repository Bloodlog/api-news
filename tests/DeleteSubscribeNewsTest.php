<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class DeleteSubscribeNewsTest extends TestCase
{
    /**
     * Удаление подписки по ID & email
     * A basic test example.
     *
     * @return void
     */
    public function testDeleteSubscribe()
    {
        $this->delete( 'api/v1/subscribe/1/user/fm@web-fomin.ru')
            ->seeJsonEquals([
                'status_code' => 200,
            ]);
    }
}
