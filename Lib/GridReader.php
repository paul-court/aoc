<?php

namespace Lib;

class GridReader
{
    private array $data = [];
    private int $longestRow = 0;
    
    public function __construct(array $data)
    {
        foreach ($data as $line) {
            $row = str_split($line);
            $this->data[] = $row;
            if (count($row) > $this->longestRow){ 
                $this->longestRow = count($row); 
            }
        }
    }
    
    public function walkTheGrid(): \Generator
    {
        for ($y = 0; $y < $this->height(); $y++) {
            for ($x = 0; $x < $this->width(); $x++) {
                yield [$x, $y];
            }
        }
    }
        
    public function readNorthFromLoc(int $x, int $y, int $len): array
    {
        $buffer = [];
        $count = 0;
        while ($this->inGrid($x, $y) && $count < $len) {
            $buffer[] = $this->atLoc($x, $y);
            $y = $y-1;
            $count++;
        }
        return $buffer;
    }
    
    public function readNorthEastFromLoc(int $x, int $y, int $len): array
    {
        $buffer = [];
        $count = 0;
        while ($this->inGrid($x, $y) && $count < $len) {
            $buffer[] = $this->atLoc($x, $y);
            $x = $x+1;
            $y = $y-1;
            $count++;
        }
        return $buffer;
    }
    
    public function readEastFromLoc(int $x, int $y, int $len): array
    {
        $buffer = [];
        $count = 0;
        while ($this->inGrid($x, $y) && $count < $len) {
            $buffer[] = $this->atLoc($x, $y);
            $x = $x+1;
            $count++;
        }
        return $buffer;
    }
    
    public function readSouthEastFromLoc(int $x, int $y, int $len): array
    {
        $buffer = [];
        $count = 0;
        while ($this->inGrid($x, $y) && $count < $len) {
            $buffer[] = $this->atLoc($x, $y);
            $x = $x+1;
            $y = $y+1;
            $count++;
        }
        return $buffer;
    }
    
    public function readSouthFromLoc(int $x, int $y, int $len): array
    {
        $buffer = [];
        $count = 0;
        while ($this->inGrid($x, $y) && $count < $len) {
            $buffer[] = $this->atLoc($x, $y);
            $y = $y+1;
            $count++;
        }
        return $buffer;
    }
    
    public function readSouthWestFromLoc(int $x, int $y, int $len): array
    {
        $buffer = [];
        $count = 0;
        while ($this->inGrid($x, $y) && $count < $len) {
            $buffer[] = $this->atLoc($x, $y);
            $x = $x-1;
            $y = $y+1;
            $count++;
        }
        return $buffer;
    }
    
    public function readWestFromLoc(int $x, int $y, int $len): array
    {
        $buffer = [];
        $count = 0;
        while ($this->inGrid($x, $y) && $count < $len) {
            $buffer[] = $this->atLoc($x, $y);
            $x = $x-1;
            $count++;
        }
        return $buffer;
    }
    
    public function readNorthWestFromLoc(int $x, int $y, int $len): array
    {
        $buffer = [];
        $count = 0;
        while ($this->inGrid($x, $y) && $count < $len) {
            $buffer[] = $this->atLoc($x, $y);
            $x = $x-1;
            $y = $y-1;
            $count++;
        }
        return $buffer;
    }
    
    public function locOf(string $char): array
    {
        for ($y = 0; $y < $this->height(); $y++) {
            if (in_array($char, $this->data[$y])) {
                $x = array_search($char, $this->data[$y]);
                return [$x, $y];
            }
        }
    }
    
    public function inGrid (int $x, int $y): bool
    {
        return isset($this->data[$y][$x]);
    }
    
    public function atLoc(int $x, int $y)
    {
        return $this->data[$y][$x] ?? null;
    }
    
    public function putAtLoc(string $thing, int $x, int $y)
    {
        $this->data[$y][$x] = $thing;
    }
    
    public function height(): int
    {
        return count($this->data);
    }
    
    public function width(): int
    {
        return $this->longestRow;
    }
    
    public function walkNorthFromLoc(int $x, int $y): \Generator
    {
        for ($i = $y; $i >= 0; $i--) {
            yield $this->atLoc($x, $i);
        }
    }
    
    public function walkSouthFromLoc(int $x, int $y): \Generator
    {
        for ($i = $y; $i < $this->height(); $i++) {
            yield $this->atLoc($x, $i);
        }
    }
    
    public function walkEastFromLoc(int $x, int $y): \Generator
    {
        for ($i = $x; $i < $this->width(); $i++) {
            yield $this->atLoc($i, $y);
        }
    }
    
    public function walkWestFromLoc(int $x, int $y): \Generator
    {
        for ($i = $x; $i >= 0; $i--) {
            yield $this->atLoc($i, $y);
        }
    }
    
    public function isEdge(int $x, int $y): bool
    {
        return (($x == 0) 
                || ($x == $this->width()-1) 
                || ($y == 0)
                || ($y == $this->height()-1));
    }
}
