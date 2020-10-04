<?php


namespace App\Repository;


use DateTime;

interface OnlineDutyRepository
{
    /**
     * @return OnlineDuty[]
     */
    public function getAll(): array;
}

class OnlineDuty
{
    private DateTime $from;

    private DateTime $to;

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
