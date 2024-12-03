<?php

namespace Year2024\Day03;

use Lib\iAoCStandard;
use Lib\InputReader;

class Main implements iAoCStandard
{
    public function title(): string
    {
        return "Mull It Over";
    }

    private function readInstructionsFromCorruptedMemory(): array
    {
        $corruptedMemory = InputReader::unbufferedCleanedLines(__DIR__);
        
        $instructions = [];
        $matches = [];
        foreach ($corruptedMemory as $memoryBlock) {
            preg_match_all("/mul\([0-9]{1,3},[0-9]{1,3}\)|do\(\)|don't\(\)/", $memoryBlock, $matches, PREG_SET_ORDER);
            foreach ($matches as $match) {
                $instructions[] = $match[0];
            }
        }
        return $instructions;
    }
    
    public function partOne(): string
    {
        $computer = new Computer();
        $instructions = $this->readInstructionsFromCorruptedMemory();
        foreach ($instructions as $instruction) {
            $computer->handle($instruction);
        }
        
        return $computer->total();
    }

    public function partTwo(): string
    {
        $computer = new Computer();
        $computer->enableConditionals();
        $instructions = $this->readInstructionsFromCorruptedMemory();
        foreach ($instructions as $instruction) {
            $computer->handle($instruction);
        }
        
        return $computer->total();
    }
}