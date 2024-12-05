<?php

namespace Year2024\Day04;

use Lib\GridReader;
use Lib\iAoCStandard;
use Lib\InputReader;

class Main implements iAoCStandard
{
    public function title(): string
    {
        return "Ceres Search";
    }

    public function partOne(): string
    {
        $lines = InputReader::cleanedLines(__DIR__);
        $grid = new GridReader($lines);
        
        $found = 0;
        for ($y = 0; $y < $grid->height(); $y++) {
            for ($x = 0; $x < $grid->width(); $x++) {
                $words = [];
                $words[] = implode("", $grid->readNorthFromLoc($x, $y, 4));
                $words[] = implode("", $grid->readNorthEastFromLoc($x, $y, 4));
                $words[] = implode("", $grid->readEastFromLoc($x, $y, 4));
                $words[] = implode("", $grid->readSouthEastFromLoc($x, $y, 4));
                $words[] = implode("", $grid->readSouthFromLoc($x, $y, 4));
                $words[] = implode("", $grid->readSouthWestFromLoc($x, $y, 4));
                $words[] = implode("", $grid->readWestFromLoc($x, $y, 4));
                $words[] = implode("", $grid->readNorthWestFromLoc($x, $y, 4));
                
                foreach ($words as $word) {
                    if ($word == "XMAS") {
                        $found++;
                    }
                }
            }
        }
        return $found;
    }

    public function partTwo(): string
    {
        $lines = InputReader::cleanedLines(__DIR__);
        $grid = new GridReader($lines);
        
        $found = 0;
        for ($y = 0; $y < $grid->height(); $y++) {
            for ($x = 0; $x < $grid->width(); $x++) {
                $seDiag = implode("", $grid->readSouthEastFromLoc($x, $y, 3));
                $swDiag = implode("", $grid->readSouthWestFromLoc($x+2, $y, 3));
                
                if (
                        (($seDiag == "MAS")||($seDiag == "SAM"))
                     && (($swDiag == "MAS")||($swDiag == "SAM"))
                ) {
                    $found++;
                }
            }
        }
        return $found;
    }
}