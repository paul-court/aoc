<?php

namespace Year2024\Day02;

class LevelComparison
{
    const TREND_ASCENDING = 1;
    const TREND_STATIC = 0;
    const TREND_DECENDING = -1;

    private int $previous;
    private int $current;

    public function __construct(int $previous, int $current)
    {
        $this->previous = $previous;
        $this->current = $current;
    }

    private function change(): int
    {
        return $this->previous - $this->current;
    }

    private function absChange(): int
    {
        return abs($this->change());
    }

    public function trend(): int
    {
        return match (true) {
            $this->change() > 0 => self::TREND_ASCENDING,
            $this->change() < 0 => self::TREND_DECENDING,
            default => self::TREND_STATIC,
        };
    }

    public function isSafe(): bool
    {
        return $this->trend() !== self::TREND_STATIC &&
            $this->absChange() >= 1 &&
            $this->absChange() <= 3;
    }

    public function isNotSafe(): bool
    {
        return !$this->isSafe();
    }
}
