<?php

namespace Year2021\Day03;

use Lib\iAoCStandard;
use Lib\InputReader;

class Main implements iAoCStandard
{
    public function title(): string
    {
        return "Binary Diagnostic";
    }

    public function partOne(): string
    {
        $lines = InputReader::cleanedLines(__DIR__);
        $diag = new BinaryDiagnostics($lines);
        $oxy = BinaryDiagnostics::find($diag, 0, true);
        $scrub = BinaryDiagnostics::find($diag, 0, false);

//        echo "Power Consumption: " . $diag->powerConsumption() . PHP_EOL;
//        echo "Oxygen: " . $oxy . PHP_EOL;
//        echo "O2 Scrubber: " . $scrub . PHP_EOL;
//        echo "Life Support: " . $oxy * $scrub . PHP_EOL;

        return $diag->powerConsumption();
    }

    public function partTwo(): string
    {
        $lines = InputReader::cleanedLines(__DIR__);
        $diag = new BinaryDiagnostics($lines);
        $oxy = BinaryDiagnostics::find($diag, 0, true);
        $scrub = BinaryDiagnostics::find($diag, 0, false);

        return $oxy * $scrub;
    }
}
