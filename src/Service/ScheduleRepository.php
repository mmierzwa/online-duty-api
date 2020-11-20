<?php

namespace App\Service;

interface ScheduleRepository
{
    /**
     * @return ScheduleItem[]
     */
    public function getAll(): array;
}
