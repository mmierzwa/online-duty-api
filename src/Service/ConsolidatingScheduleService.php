<?php


namespace App\Service;


class ConsolidatingScheduleService implements ScheduleService
{
    private ScheduleRepository $repository;

    /**
     * ScheduleService constructor.
     * @param ScheduleRepository $repository
     */
    public function __construct(ScheduleRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return ScheduleItem[]
     */
    public function getAll(): array
    {
        $schedule = $this->repository->getAll();
        $schedule = $this->consolidate($schedule);
        return $schedule;
    }

    /**
     * @param ScheduleItem[] $schedule
     * @return ScheduleItem[]
     */
    private function consolidate(array $schedule): array
    {
        $consolidated = [];
        $currFrom = $schedule[0]->getFrom();
        $currTo = $schedule[0]->getTo();
        for ($i = 1; $i < count($schedule); $i++) {
            if ($schedule[$i]->getFrom() == $currTo) {
                $currTo = $schedule[$i]->getTo();
                continue;
            }

            $consolidatedItem = new ScheduleItem($currFrom, $currTo);
            array_push($consolidated, $consolidatedItem);

            $currFrom = $schedule[$i]->getFrom();
            $currTo = $schedule[$i]->getTo();
        }

        $consolidatedItem = new ScheduleItem($currFrom, $currTo);
        array_push($consolidated, $consolidatedItem);

        return $consolidated;
    }
}
