<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class DeleteSubscribesNewsTest extends TestCase
{
    /**
     * Удаление всех подписок по email
     * A basic test example.
     *
     * @return void
     */
    public function testDeleteSubscribes()
    {
        $email = 'fm@web-fomin.ru';
        $this->delete( 'api/v1/subscriptions/user/' . $email)
            ->seeJsonEquals([
                'status_code' => 200,
            ]);
    }
}
