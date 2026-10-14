<?php

namespace App\Legacy\License;

final class TimeAvailability
{
    /**
     * @var array<int, array<int, array{0: string, 1: string}>>
     */
    private const TIME_GROUPS = [
        0 => [
            ['07:00', '08:30'],
            ['11:30', '13:00'],
        ],
        1 => [
            ['08:30', '10:00'],
            ['13:00', '14:30'],
        ],
        2 => [
            ['10:00', '11:30'],
            ['14:30', '16:00'],
        ],
    ];

    public static function notIn(mixed $timeGroup): bool
    {
        if (! is_numeric($timeGroup) || ! isset(self::TIME_GROUPS[(int) $timeGroup])) {
            return false;
        }

        $now = self::toInt(date('G:i'));

        foreach (self::TIME_GROUPS[(int) $timeGroup] as [$from, $to]) {
            if ($now >= self::toInt($from) && $now < self::toInt($to)) {
                return false;
            }
        }

        return true;
    }

    public static function getTimes(mixed $timeGroup): string
    {
        if (! is_numeric($timeGroup) || ! isset(self::TIME_GROUPS[(int) $timeGroup])) {
            return '';
        }

        $parts = [];

        foreach (self::TIME_GROUPS[(int) $timeGroup] as [$from, $to]) {
            $parts[] = "od {$from} do {$to}";
        }

        return implode(' i ', $parts);
    }

    private static function toInt(string $time): int
    {
        return (int) str_replace(':', '', $time);
    }
}
