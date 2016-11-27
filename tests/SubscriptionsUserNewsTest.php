<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SubscriptionsUserNewsTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testSubscribeUser()
    {
        $email = 'fm@web-fomin.ru';
        $limit = 1;
        $offset = 1;
        $this->get('subscriptions/user/' . $email . '?limit=' . $limit . '&offset=' . $offset)
            ->seeJsonEquals([
                'status_code' => 200,
            ]);
    }
}
