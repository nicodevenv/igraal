<?php

namespace CommissionBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testGetUserCommissions()
    {
        $client = static::createClient();

        $client->request('GET', '/commissions/1');

        $userCommissions = json_decode($client->getResponse()->getContent(), true);

        $this->assertEquals(5, count($userCommissions));
    }
}
