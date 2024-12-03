<?php

namespace Year2021\Day02;

use Lib\iAoCStandard;
use Lib\InputReader;

class Main implements iAoCStandard
{
    public function title(): string
    {
        return "Dive!";
    }

    public function partOne(): string
    {
        $hPos = 0;
        $depth = 0;
        
        $lines = InputReader::cleanedLines(__DIR__);
        for ($i = 0; $i < count($lines); $i++) {
            list($direction, $distance) = explode(" ", $lines[$i]);
            switch ($direction) {
                case "forward":
                    $hPos += $distance;
                    break;
                case "down":
                    $depth += $distance;
                    break;
                case "up":
                    $depth -= $distance;
                    break;
                default:
                    die("Bad direction");
            }
        }

        return ($hPos * $depth);
    }

    public function partTwo(): string
    {
        $hPos = 0;
        $depth = 0;
        $aim = 0;
        
        $lines = InputReader::cleanedLines(__DIR__);
        for ($i = 0; $i < count($lines); $i++) {
            list($direction, $distance) = explode(" ", $lines[$i]);
            switch ($direction) {
                case "forward":
                    $hPos += $distance;
                    $depth += ($aim * $distance);
                    break;
                case "down":
                    $aim += $distance;
                    break;
                case "up":
                    $aim -= $distance;
                    break;
                default:
                    die("Bad direction");
            }
        }

        return ($hPos * $depth);
    }
}
