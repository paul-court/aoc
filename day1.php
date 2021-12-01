<?php

$input = file('day1_input.txt');
$numIncreases = 0;
for ($i = 0; $i < count($input); $i++) {
    if (($i > 0) && ($input[$i] > $input[$i-1])) {
        $numIncreases++;
    }
}

$numWindowIncreases = 0;
$previousSum = null;
for ($i = 2; $i < count($input); $i++) {
    $sum = $input[$i] + $input[$i-1] + $input[$i-2];
    
    if ($previousSum == null) {
        $previousSum = $sum;
        continue;
    }
    
    if ($sum > $previousSum) {
        $numWindowIncreases++;
    }
    
    $previousSum = $sum;
}

echo "Answer 1: " . $numIncreases . PHP_EOL;
echo "Answer 2: " . $numWindowIncreases . PHP_EOL;