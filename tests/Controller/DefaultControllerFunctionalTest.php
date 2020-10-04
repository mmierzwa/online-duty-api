<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerFunctionalTest extends WebTestCase
{
    public function testAllReturnsAllDutiesOrderedByDate()
    {
        // given
        $client = static::createClient();
        $client->disableReboot();

        $expected = json_encode(
            [
                [
                    'from' => '2020-01-07T15:00:00.000+02:00',
                    'to' => '2020-01-07T17:00:00.000+02:00'
                ],
                [
                    'from' => '2020-01-07T17:00:00.000+02:00',
                    'to' => '2020-01-07T18:00:00.000+02:00'
                ]
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
}
