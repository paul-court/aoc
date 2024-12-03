<?php

namespace Year2024\Day03;

class Computer
{
    private $conditionalsEnabled = false;
    private $mulEnabled = true;
    
    private $total = 0;
    
    public function handle(string $instruction): void
    {
        $cmd = str_replace("'", "", strtok($instruction, "("));
        switch ($cmd) {
            case "mul": 
                $this->mul(strtok(","), strtok(")"));
                break;
            case "do":
                $this->do();
                break;
            case "dont":
                $this->dont();
                break;
        }
    }
    
    public function enableConditionals(): void
    {
        $this->conditionalsEnabled = true;
    }
    
    public function total(): int
    {
        return (int) $this->total;
    }
    
    private function mul($p1, $p2): void
    {
        if ($this->mulEnabled) {
            $this->total += $p1 * $p2;
        }
    }
    
    private function do(): void
    {
        if ($this->conditionalsEnabled) {
            $this->mulEnabled = true;
        }
    }
    
    private function dont(): void
    {
        if ($this->conditionalsEnabled) {
            $this->mulEnabled = false;
        }
    }
}