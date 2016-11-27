<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class DeleteSubscribesNewsTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testDeleteSubscribes(){
        $this->delete( 'api/v1/subscriptions/user/fm@web-fomin.ru')
            ->seeJsonEquals([
                'status_code' => 200,
            ]);
    }
}
