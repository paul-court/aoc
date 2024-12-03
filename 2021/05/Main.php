<?php

namespace Year2021\Day05;

use Lib\iAoCStandard;
use Lib\InputReader;

class Main implements iAoCStandard
{
    public function title(): string
    {
        return "Hydrothermal Venture";
    }

    public function partOne(): string
    {
        return "one";
    }

    public function partTwo(): string
    {
        $intersects = [];
        $dangerPoints = [];
        
        $lines = InputReader::cleanedLines(__DIR__);
        foreach ($lines as $raw) {
            foreach (Line::fromVentData($raw)->points() as list($x, $y)) {
                if (!isset($intersects[$x][$y])) {
                    $intersects[$x][$y] = 0;
                }
                $intersects[$x][$y]++;

                if ($intersects[$x][$y] >= 2) {
                    $dangerPoints[] = $x . ':' . $y;
                }
            }
        }
        $dangerPoints = array_unique($dangerPoints);

        return count($dangerPoints);
    }
}
