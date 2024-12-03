<?php

namespace Year2024\Day01;

use Lib\iAoCStandard;
use Lib\InputReader;

class Main implements iAoCStandard
{
    public function title(): string
    {
        return "Historian Hysteria";
    }

    private function inputToLists(): array
    {
        $listOne = [];
        $listTwo = [];

        foreach (InputReader::unbufferedCleanedLines(__DIR__) as $line) {
            list($strOne, $strTwo) = explode(
                limit: 2,
                separator: " ",
                string: $line
            );
            $listOne[] = (int) trim($strOne);
            $listTwo[] = (int) trim($strTwo);
        }

        return [$listOne, $listTwo];
    }

    public function partOne(): string
    {
        list($listOne, $listTwo) = $this->inputToLists();
        sort($listOne, SORT_NUMERIC);
        sort($listTwo, SORT_NUMERIC);

        $totalDistance = 0;
        while (!empty($listOne) && !empty($listTwo)) {
            $dist = abs(array_shift($listOne) - array_shift($listTwo));
            $totalDistance += $dist;
        }

        return $totalDistance;
    }

    public function partTwo(): string
    {
        list($listOne, $listTwo) = $this->inputToLists();
        $occurances = array_count_values($listTwo);
        $total = 0;
        foreach ($listOne as $value) {
            $total += $value * ($occurances[$value] ?? 0);
        }

        return $total;
    }
}
