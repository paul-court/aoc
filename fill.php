#!/usr/bin/env php
<?php

for ($year = 2015; $year <= date("Y"); $year++) {
    for ($day = 1; $day <= 24; $day++) {
        
        $dirname = sprintf("%s/%02s", $year, $day);
        if (!is_dir($dirname)) {
            system("mkdir -p \"${dirname}\"");
        }
        
        $filename = $dirname . "/Main.php";
        $paddedDay = sprintf("%02s", $day);
        if (!is_file($filename)) {
            $contents = <<<EOF
            <?php
            
            namespace Year${year}\Day${paddedDay};
            
            use Lib\iAoCStandard;
            
            class Main implements iAoCStandard
            {
                public function title(): string
                {
                    return "Day ${day}";
                }

                public function partOne(): string
                {
                    return "Not implemented yet!";
                }

                public function partTwo(): string
                {
                    return "Not implemented yet!";
                }
            }
            EOF;
            
            file_put_contents($filename, $contents);
        }
    }
}

