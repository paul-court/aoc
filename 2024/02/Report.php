<?php

namespace Year2024\Day02;

class Report
{
    private array $levels = [];
    private array $levelComparision = [];

    public function __construct(array $levels)
    {
        $this->initLevels($levels);
    }

    private function initLevels(array $levels): void
    {
        $this->levels = $levels;
        $this->levelComparision = [];

        for ($i = 1; $i < count($this->levels); $i++) {
            $this->levelComparision[] = new LevelComparison(
                $levels[$i - 1],
                $levels[$i]
            );
        }
    }

    private function areComparisionsSafe(): bool
    {
        $isSafe = array_reduce(
            $this->levelComparision,
            function ($c, $i) {
                return $c && $i->isSafe();
            },
            true
        );

        return $isSafe;
    }

    private function trendValues(): array
    {
        $trends = array_reduce(
            $this->levelComparision,
            function ($c, $i) {
                $c[] = $i->trend();
                return $c;
            },
            []
        );
        return $trends;
    }

    public function isSafe(): bool
    {
        $levelChangesAreSafe = $this->areComparisionsSafe();
        $trends = $this->trendValues();
        $uniqueTrends = array_unique($trends);
        $trendIsSafe = count($uniqueTrends) == 1 ? true : false;

        return $levelChangesAreSafe && $trendIsSafe;
    }

    public function dampen(): void
    {
        if ($this->isSafe()) {
            return; // dampening not needed
        }

        $originalLevels = $this->levels;
        for ($i = 0; $i < count($originalLevels); $i++) {
            $dampenedLevels = $originalLevels;
            array_splice($dampenedLevels, $i, 1, []);
            $this->initLevels($dampenedLevels);
            if ($this->isSafe()) {
                break;
            }
        }
    }
}
