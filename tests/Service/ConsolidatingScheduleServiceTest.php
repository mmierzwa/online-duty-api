<?php

namespace App\Tests\Service;

use App\Service\ConsolidatingScheduleService;
use App\Service\ScheduleItem;
use App\Service\ScheduleRepository;
use DateTime;
use PHPUnit\Framework\TestCase;

class ConsolidatingScheduleServiceTest extends TestCase
{
    public function testGetAll()
    {
        // given
        $expected = [
            new ScheduleItem(new DateTime('2020-11-19T08:00:00+0100'), new DateTime('2020-11-19T11:00:00+0100')),
            new ScheduleItem(new DateTime('2020-11-19T12:00:00+0100'), new DateTime('2020-11-19T15:00:00+0100')),
            new ScheduleItem(new DateTime('2020-11-19T21:00:00+0100'), new DateTime('2020-11-20T01:00:00+0100')),
            new ScheduleItem(new DateTime('2020-12-14T18:00:00+0100'), new DateTime('2020-12-14T20:00:00+0100'))
        ];

        $repository = $this->createMock(ScheduleRepository::class);
        $repository->expects($this->once())
            ->method('getAll')
            ->willReturn([
                new ScheduleItem(new DateTime('2020-11-19T08:00:00.000'), new DateTime('2020-11-19T10:00:00.000')),
                new ScheduleItem(new DateTime('2020-11-19T10:00:00.000'), new DateTime('2020-11-19T11:00:00.000')),
                new ScheduleItem(new DateTime('2020-11-19T12:00:00.000'), new DateTime('2020-11-19T15:00:00.000')),
                new ScheduleItem(new DateTime('2020-11-19T21:00:00.000'), new DateTime('2020-11-20T00:00:00.000')),
                new ScheduleItem(new DateTime('2020-11-20T00:00:00.000'), new DateTime('2020-11-20T01:00:00.000')),
                new ScheduleItem(new DateTime('2020-12-14T18:00:00.000'), new DateTime('2020-12-14T20:00:00.000'))
            ]);

        $target = new ConsolidatingScheduleService($repository);

        // when
        $actual = $target->getAll();

        // then
        $this->assertEquals($expected, $actual);
    }
}
