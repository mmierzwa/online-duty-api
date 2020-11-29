<?php

namespace App\Service;

use DateTime;

class ScheduleItem
{
    private DateTime $from;

    private DateTime $to;

    /**
     * OnlineDuty constructor.
     * @param DateTime $from
     * @param DateTime $to
     */
    public function __construct(DateTime $from, DateTime $to)
    {
        $this->from = $from;
        $this->to = $to;
    }

    /**
     * @return DateTime
     */
    public function getFrom(): DateTime
    {
        return $this->from;
    }

    /**
     * @param DateTime $from
     */
    public function setFrom(DateTime $from): void
    {
        $this->from = $from;
    }

    /**
     * @return DateTime
     */
    public function getTo(): DateTime
    {
        return $this->to;
    }

    /**
     * @param DateTime $to
     */
    public function setTo(DateTime $to): void
    {
        $this->to = $to;
    }
}
