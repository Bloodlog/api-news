<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;


class AuthSubscriptionsUserTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testAuthSubscriptionsUser()
    {
        $email = 'fm@web-fomin.ru';
        $limit = 1;
        $offset = 1;
        $xml = '&xml=false';
        $accessToken = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJhcGktbmV3cyIsInN1YiI6IjExMTIyMjMzMyIsImlhdCI6MTQ4MDM5ODI4MCwiZXhwIjoxNDgwNDE2MjgwfQ.pR_XMHGVc2jDt23j55EoM4zyjpoOsC-6cAgOHZBTO44';
        $responce = $this->post('subscriptions/user/' . $email . '?limit=' . $limit . '&offset=' . $offset . $xml, [] ,['HTTP_Authorization' => 'Bearer '.$accessToken])
            ->seeJsonEquals([
                'status_code' => 200,
            ]);

    }
}
