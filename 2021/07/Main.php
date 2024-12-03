<?php

namespace Day07;

class Main extends \Base
{
    public function title(): string
    {
        return "The Treachery of Whales";
    }

    public function partOne(): string
    {
        $subData = explode(",", $this->lines[0]);
        $posRange = array_reduce($subData, function ($carry, $item) {
            if ($item < $carry['min']) {
                $carry['min'] = $item;
            }
            if ($item > $carry['max']) {
                $carry['max'] = $item;
            }
            return $carry;
        }, ['min' => PHP_INT_MAX, 'max' => 0]);

        $fuelToPos = array_fill(0, $posRange['max'], 0);
        for ($p = 0; $p < $posRange['max']; $p++) {
            for ($s = 0; $s < count($subData); $s++) {
                $distance = abs($p - $subData[$s]);
                for ($i = 1; $i <= $distance; $i++) {
                    $fuelToPos[$p] += 1;
                }
            }
        }

        return min($fuelToPos);
    }

    public function partTwo(): string
    {
        $subData = explode(",", $this->lines[0]);
        $posRange = array_reduce($subData, function ($carry, $item) {
            if ($item < $carry['min']) {
                $carry['min'] = $item;
            }
            if ($item > $carry['max']) {
                $carry['max'] = $item;
            }
            return $carry;
        }, ['min' => PHP_INT_MAX, 'max' => 0]);

        $fuelToPos = array_fill(0, $posRange['max'], 0);
        for ($p = 0; $p < $posRange['max']; $p++) {
            for ($s = 0; $s < count($subData); $s++) {
                $distance = abs($p - $subData[$s]);
                for ($i = 1; $i <= $distance; $i++) {
                    $fuelToPos[$p] += $i;
                }
            }
        }

        return min($fuelToPos);
    }
}
