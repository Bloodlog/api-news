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
        $rubric_id = 2;
        $email = 'bloodlog@mail.ru';
        $this->post('api/v1/subscribe/' . $rubric_id. '/user/' . $email)
            ->seeJsonEquals([
                'status_code' => 200,
            ]);
    }
}
