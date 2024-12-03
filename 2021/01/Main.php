<?php

namespace Year2021\Day01;

use Lib\iAoCStandard;
use Lib\InputReader;

class Main implements iAoCStandard
{
    public function title(): string
    {
        return "Sonar Sweep";
    }

    public function partOne(): string
    {
        $lines = InputReader::cleanedLines(__DIR__);
        $numIncreases = 0;
        for ($i = 1; $i < count($lines); $i++) {
            if ($lines[$i] > $lines[$i - 1]) {
                $numIncreases++;
            }
        }
        return $numIncreases;
    }

    public function partTwo(): string
    {
        $lines = InputReader::cleanedLines(__DIR__);
        
        $numWindowIncreases = 0;
        $previousSum = null;

        for ($i = 2; $i < count($lines); $i++) {
            $sum = $lines[$i] + $lines[$i - 1] + $lines[$i - 2];
            if ($previousSum == null) {
                $previousSum = $sum;
                continue;
            }
            if ($sum > $previousSum) {
                $numWindowIncreases++;
            }
            $previousSum = $sum;
        }

        return $numWindowIncreases;
    }
}
