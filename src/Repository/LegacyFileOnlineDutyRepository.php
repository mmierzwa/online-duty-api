<?php

namespace App\Repository;

use DateTime;
use PHPUnit\Exception;

class LegacyFileOnlineDutyRepository implements OnlineDutyRepository
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
        $schedule = $this->readScheduleFile();
        return $schedule;
    }

    /**
     * @return OnlineDuty[]
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

    private function lineToOnlineDuty(string $line): OnlineDuty
    {
        try {
            preg_match('/^(?<year>\d{4})\|(?<month>\d{2})\|(?<day>\d{2})\|(?<startHour>\d{2})\|(?<endHour>\d{2})/', $line, $matches);

            $year = $matches['year'];
            $month = $matches['month'];
            $day = $matches['day'];
            $startHour = $matches['startHour'];
            $endHour = $matches['endHour'];

            $start = sprintf('%s-%s-%s %s:00:00.000', $year, $month, $day, $startHour);
            $end = sprintf('%s-%s-%s %s:00:00.000', $year, $month, $day, $endHour);

            return new OnlineDuty(
                new DateTime($start),
                new DateTime($end)
            );
        } catch (\Exception $ex) {
            throw new LegacyFileFormatException('schedule file has wrong format', 0, $ex);
        }
    }
}
