<?php

namespace App\Repository;

use App\Service\ScheduleItem;
use App\Service\ScheduleRepository;
use DateInterval;
use DateTime;
use Exception;

class LegacyFileScheduleRepository implements ScheduleRepository
{
    /**
     * @var string
     */
    private string $scheduleFilePath;

    public function __construct(string $scheduleFilePath)
    {
        $this->scheduleFilePath = $scheduleFilePath;
    }

    /**
     * @inheritDoc
     */
    public function getAll(): array
    {
        return $this->readScheduleFile();
    }

    /**
     * @return ScheduleItem[]
     * @throws LegacyFileFormatException
     */
    private function readScheduleFile(): array
    {
        $content = file_get_contents($this->scheduleFilePath);
        $converted = iconv('ISO-8859-2', 'UTF-8', $content);
        $byLines = explode("\n", $converted);

        $schedule = [];
        foreach ($byLines as $line) {
            if (strlen($line) > 0) {
                array_push($schedule, $this->lineToOnlineDuty($line));
            }
        }

        return $schedule;
    }

    private function lineToOnlineDuty(string $line): ScheduleItem
    {
        try {
            preg_match('/^(?<year>\d{4})\|(?<month>\d{2})\|(?<day>\d{2})\|(?<startHour>\d{2})\|(?<endHour>\d{2})/', $line, $matches);

            $year = $matches['year'];
            $month = $matches['month'];
            $day = $matches['day'];
            $startHour = $matches['startHour'];
            $endHour = $matches['endHour'];

            $start = $this->toDate($year, $month, $day, $startHour);
            $end = $this->toDate($year, $month, $day, $endHour);

            if ($endHour == "00")
            {
                $end = $end->add(new DateInterval('P1D'));
            }

            return new ScheduleItem($start, $end);
        } catch (Exception $ex) {
            throw new LegacyFileFormatException('schedule file has wrong format', 0, $ex);
        }
    }

    private function toDate(string $year, string $month, string $day, string $hour): DateTime
    {
        $dateStr = sprintf('%s-%s-%s %s:00:00.000', $year, $month, $day, $hour);
        return new DateTime($dateStr);
    }
}
