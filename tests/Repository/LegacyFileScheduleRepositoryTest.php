<?php

namespace App\Tests\Repository;

use App\Repository\LegacyFileScheduleRepository;
use App\Service\ScheduleItem;
use DateTime;
use PHPUnit\Framework\TestCase;

class LegacyFileScheduleRepositoryTest extends TestCase
{

    public function testGetAll()
    {
        // given
        $expected = [
            new ScheduleItem(new DateTime('2020-11-19T08:00:00.000'), new DateTime('2020-11-19T10:00:00.000')),
            new ScheduleItem(new DateTime('2020-11-19T10:00:00.000'), new DateTime('2020-11-19T11:00:00.000')),
            new ScheduleItem(new DateTime('2020-11-19T12:00:00.000'), new DateTime('2020-11-19T15:00:00.000')),
            new ScheduleItem(new DateTime('2020-11-19T21:00:00.000'), new DateTime('2020-11-20T00:00:00.000')),
            new ScheduleItem(new DateTime('2020-11-20T00:00:00.000'), new DateTime('2020-11-20T01:00:00.000')),
            new ScheduleItem(new DateTime('2020-12-14T18:00:00.000'), new DateTime('2020-12-14T20:00:00.000'))
        ];

        $target = new LegacyFileScheduleRepository('tests/TestData/schedule.dat');

        // when
        $actual = $target->getAll();

        // then
        $this->assertEquals($expected, $actual);
    }
}
