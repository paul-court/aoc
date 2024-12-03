<?php

namespace Year2024\Day02;

use Lib\iAoCStandard;
use Lib\InputReader;

class Main implements iAoCStandard
{
    public function title(): string
    {
        return "Red-Nosed Reports";
    }

    public function partOne(): string
    {
        $safeReports = 0;
        foreach (InputReader::unbufferedCleanedLines(__DIR__) as $line) {
            $levels = explode(" ", $line);
            $report = new Report($levels);
            if ($report->isSafe()) {
                $safeReports++;
            }
        }

        return $safeReports;
    }

    public function partTwo(): string
    {
        $safeReports = 0;
        foreach (InputReader::unbufferedCleanedLines(__DIR__) as $line) {
            $levels = explode(" ", $line);
            $report = new Report($levels);
            $report->dampen();
            if ($report->isSafe()) {
                $safeReports++;
            }
        }

        return $safeReports;
    }
}
