<?php

namespace Year2024\Day06;

class Guard
{
    private int $startX;
    private int $startY;
    
    private int $curX;
    private int $curY;
    
    // 0=N, 1=E, 2=S, 3=W
    private int $direction;
    
    private \Lib\GridReader $map;
    
    public function __construct(
            int $x,
            int $y,
            \Lib\GridReader $map
    ) {
        $this->startX = $x;
        $this->startY = $y;
        $this->curX = $x;
        $this->curY = $y;
        $this->map = $map;
        $this->direction = 0;
    }

    public function goBackToStart(): void
    {
        $this->curX = $this->startX;
        $this->curY = $this->startY;
        $this->direction = 0;
    }
    
    public function pos(): string
    {
        return $this->x() . "," . $this->y();
    }
    
    public function posWithDir(): string
    {
        return $this->direction . ":" . $this->pos();
    }
    
    public function x(): int
    {
        return $this->curX;
    }
    
    public function y(): int
    {
        return $this->curY;
    }
    
    public function move(): void 
    {
        if ($this->infrontOfMe() == "#") {
            $this->rotate();
        } else {
            $this->moveForwards();
        }
    }
    
    private function infrontOfMe(): string
    {
        $contents = match($this->direction) {
            0 => $this->map->atLoc($this->curX, $this->curY-1),
            1 => $this->map->atLoc($this->curX+1, $this->curY),
            2 => $this->map->atLoc($this->curX, $this->curY+1),
            3 => $this->map->atLoc($this->curX-1, $this->curY),
        };
        return (string)$contents;
    }
    
    private function rotate(): void
    {
        $this->direction++;
        if ($this->direction > 3) {
            $this->direction = 0;
        }
    }
    
    private function moveForwards(): void
    {
        switch ($this->direction) {
            case 0: $this->curY--; break;
            case 1: $this->curX++; break;
            case 2: $this->curY++; break;
            case 3: $this->curX--; break;
        }
    }
    
    
    
}