<?php


namespace App\Service;


interface ScheduleService
{
    /**
     * @return ScheduleItem[]
     */
    function getAll(): array;
}
