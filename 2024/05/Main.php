<?php

namespace Year2024\Day05;

use Lib\iAoCStandard;

class Main implements iAoCStandard
{
    public function title(): string
    {
        return "Print Queue";
    }

    private function parseInput(): array
    {
        $lines = \Lib\InputReader::unbufferedCleanedLines(__DIR__);
        $orderRules = [];
        $updates = [];
        foreach ($lines as $line) {
            if (empty($line)) {
                continue;
            }
            if (str_contains($line, "|")) {
                $orderRules[] = explode("|", $line);
            } else {
                $updates[] = explode(",", $line);
            }
        }
        return [$orderRules, $updates];
    }
    
    public function partOne(): string
    {
        list ($orderingRules, $updates) = $this->parseInput();
        
        $sumOfCorrectMidPageNums = 0;
        foreach ($updates as $update) {
            $printUpdate = new Update($update, $orderingRules);
            if ($printUpdate->isCorrect()) {
                $sumOfCorrectMidPageNums += $printUpdate->middlePage();
            }
        }
        
        return $sumOfCorrectMidPageNums;
    }

    public function partTwo(): string
    {
        list ($orderingRules, $updates) = $this->parseInput();
        
        $sumOfCorrectedUpdateMidPages = 0;
        foreach ($updates as $update) {
            $printUpdate = new Update($update, $orderingRules);
            if ($printUpdate->isCorrect()) {
                continue;
            }
            $printUpdate->sort();
            $sumOfCorrectedUpdateMidPages += $printUpdate->middlePage();
        }
        
        return $sumOfCorrectedUpdateMidPages;
    }
}