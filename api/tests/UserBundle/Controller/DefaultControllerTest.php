<?php

namespace UserBundle\Tests\Controller;


use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testGetAction()
    {
        $client = static::createClient();

        $client->request('GET', '/user/1');

        $this->assertEquals([
            'id' => 1,
            'email' => 'elodie@test.com',
            'password' => 'testelodie',
            'name' => 'Elodie',
            'profileUrl' => 'https://randomuser.me/api/portraits/women/40.jpg',
            'lastLogin' => '2017-01-01 10:30:20',
            'creationDate' => '2018-02-01 15:17:32'
        ], json_decode($client->getResponse()->getContent(), true));
    }

    public function testRegisterAction()
    {
        $client = static::createClient();
        $client->request(
            'POST',
            '/user/register',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode([
                'name' => 'nicolas',
                'email' => 'nico-chung@hotmail.fr',
                'password' => '123456',
                'profileUrl' => '',
            ])
        );
        $createdUser= json_decode($client->getResponse()->getContent(), true);

        $getClient = static::createClient();
        $getClient->request('GET', '/user/' . $createdUser['id']);
        $retrievedUser = json_decode($getClient->getResponse()->getContent(), true);
        $retrievedUser['creationDate'] = null;

        $this->assertEquals($retrievedUser, $createdUser);
    }

    public function testLoginAction()
    {
        // Logged in successfully
        $client = static::createClient();
        $client->request(
            'POST',
            '/user/login',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode([
                'email' => 'nico-chung@hotmail.fr',
                'password' => '123456',
            ])
        );
        $loggedUser= json_decode($client->getResponse()->getContent(), true);

        $getClient = static::createClient();
        $getClient->request('GET', '/user/' . $loggedUser['id']);
        $retrievedUser = json_decode($getClient->getResponse()->getContent(), true);

        $this->assertEquals($retrievedUser, $loggedUser);

        //log in fails

        $client = static::createClient();
        $client->request(
            'POST',
            '/user/login',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode([
                'email' => 'nico-chung@hotmail.fr',
                'password' => 'zsdfgsiukhsdgdgjshd', // fake password
            ])
        );
        $loggedUser= json_decode($client->getResponse()->getContent(), true);

        $this->assertTrue(empty($loggedUser));
    }
}
