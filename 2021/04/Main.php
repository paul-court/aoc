<?php

namespace Year2021\Day04;

use Lib\iAoCStandard;
use Lib\InputReader;

class Main implements iAoCStandard
{
    private ?Card $first = null;
    private ?Card $last = null;

    public function title(): string
    {
        return "Giant Squid";
    }

    public function partOne(): string
    {
        $lines = InputReader::cleanedLines(__DIR__);
        $loader = new DataLoader($lines);

        $callSequence = $loader->callSequence();
        $cards = $loader->cards();

        printf(
            "Loaded %s caller values and %d cards\n",
            count($callSequence),
            count($cards)
        );

        $game = new Bingo($callSequence, $cards);
        list($this->first, $this->last) = $game->play();

        return $this->first->score();
    }

    public function partTwo(): string
    {
        return $this->last->score();
    }
}
