<?php

namespace Year2024\Day06;

use Lib\GridReader;
use Lib\iAoCStandard;
use Lib\InputReader;

class Main implements iAoCStandard
{
    private array $directionMethod = [
            'walkNorthFromLoc',
            'walkEastFromLoc',
            'walkSouthFromLoc',
            'walkWestFromLoc'
    ];
    
    private $direction = 0;
    
    public function title(): string
    {
        return "Guard Gallivant";
    }

    public function visitedLocations(): array
    {
        $map = new GridReader(InputReader::cleanedLines(__DIR__));
        list ($x, $y) = $map->locOf("^");
        $guard = new Guard($x, $y, $map);
        
        $watchdog = 0;
        $visitedLocations = [];
        do {
            $visitedLocations[] = $guard->pos();
            $guard->move();
            
            if ($watchdog++ > 50000) {
                exit;
            }
        } while ($map->inGrid($guard->x(), $guard->y()));
        
        $uniqueLocations = array_unique($visitedLocations);
        return $uniqueLocations;
    }
    
    public function partOne(): string
    {
        $uniqueLocations = $this->visitedLocations();
        return count($uniqueLocations);
    }

    public function partTwo(): string
    {
        $map = new GridReader(InputReader::cleanedLines(__DIR__));
        list ($x, $y) = $map->locOf("^");
        $guard = new Guard($x, $y, $map);
        
        $obstructionCausesLoop = 0;
        foreach ($this->visitedLocations() as $possibleObsticleLoc) {
            list($x, $y) = explode(",", $possibleObsticleLoc);
            
            // Can only put obsticles in empty locations.
            if ($map->atLoc($x, $y) !== ".") {
                continue;
            }
            
            // Place obsticle and check for loop.
            $map->putAtLoc("#", $x, $y);
            $guard->goBackToStart();
            
            $visitedLocations = [];
            do {    
                if (in_array($guard->posWithDir(), $visitedLocations)) {
                    $obstructionCausesLoop++;
                    break;
                }
                $visitedLocations[] = $guard->posWithDir();
                $guard->move();
            } while ($map->inGrid($guard->x(), $guard->y()));
            
            $map->putAtLoc(".", $x, $y);
        }
        
        return $obstructionCausesLoop;
    }
}