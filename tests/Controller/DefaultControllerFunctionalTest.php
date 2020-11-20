<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerFunctionalTest extends WebTestCase
{
    public function testAllReturnsAllDutiesOrderedByDate()
    {
        // given
        $client = static::createClient();

        $expected = json_encode(
            [
                [
                    'from' => '2020-11-19T08:00:00+0100',
                    'to' => '2020-11-19T11:00:00+0100'
                ],
                [
                    'from' => '2020-11-19T12:00:00+0100',
                    'to' => '2020-11-19T15:00:00+0100'
                ],
                [
                    'from' => '2020-11-19T21:00:00+0100',
                    'to' => '2020-11-20T01:00:00+0100'
                ],
                [
                    'from' => '2020-12-14T18:00:00+0100',
                    'to' => '2020-12-14T20:00:00+0100'
                ],
            ]
        );

        // when
        $client->request('GET', '/');

        // then
        $this->assertEquals(200,
            $client->getResponse()->getStatusCode());
        $this->assertJsonStringEqualsJsonString($expected,
            $client->getResponse()->getContent());
    }

    public function testReturnsCorsHeaders() {
        // given
        $client = static::createClient();

        // when
        $client->request('GET', '/');

        // then
        $this->assertResponseHeaderSame('Access-Control-Allow-Origin', '*');
        $this->assertResponseHeaderSame('Access-Control-Allow-Methods', 'GET,HEAD,OPTIONS');
        $this->assertResponseHeaderSame('Access-Control-Allow-Headers', '*');
    }
}
