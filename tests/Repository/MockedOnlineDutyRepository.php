<?php

namespace App\Tests\Repository;

use App\Repository\OnlineDutyRepository;
use DateTime;

class MockedOnlineDutyRepository implements OnlineDutyRepository
{
    /**
     * @inheritDoc
     */
    public function getAll(): array
    {
        return [
            [
                'from' => new DateTime('2020-01-07T15:00:00.000+02:00'),
                'to' => new DateTime('2020-01-07T17:00:00.000+02:00')
            ],
            [
                'from' => new DateTime('2020-01-07T17:00:00.000+02:00'),
                'to' => new DateTime('2020-01-07T18:00:00.000+02:00')
            ]
        ];
    }
}
