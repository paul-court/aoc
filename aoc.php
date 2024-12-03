#!/usr/bin/env php
<?php
spl_autoload_register(function ($className) {
    $base = __DIR__ . "/";

    $file = $base .
            str_replace(["\\", "Year", "Day"], ["/", "", ""], $className) .
            ".php";
    if (file_exists($file)) {
        require_once $file;
    }
});

define("DEFAULT_YEAR", date("Y"));
define("START_TIME", microtime(true));

$YEAR = date("Y");
$MIN_DAY = 1;
$MAX_DAY = date("j");
$TEST_MODE = false;

while (!empty($argv)) {
    $arg = array_shift($argv);
    switch (true) {
        case ($arg == "-t"):
            $TEST_MODE = true;
            break;
        case ($arg >= 1) && ($arg <= 24):
            $MIN_DAY = $MAX_DAY = $arg;
            break;
        case ($arg >= 2015) && ($arg <= date("Y")):
            $YEAR = $arg;
            $MIN_DAY = 1;
            $MAX_DAY = 24;
            break;
    };
}

define("TEST_MODE", $TEST_MODE);
define("MIN_DAY", $MIN_DAY);
define("MAX_DAY", $MAX_DAY);
define("YEAR", $YEAR);

system("figlet AoC " . YEAR);
printf("            --  Days %s to %s  --  \n", MIN_DAY, MAX_DAY);

for ($d = MIN_DAY; $d <= MAX_DAY; $d++) {
    $mainClassName = sprintf("Year%s\Day%02s\Main", YEAR, $d);
    $mainClass = new $mainClassName();

    if (!$mainClass instanceof \Lib\iAoCStandard) {
        $title = sprintf("\nDay %s: %s", $d, "Non-standard implementation - skipping");
        printf("%s\n%s\n", $title, str_pad("", strlen($title) - 1, "-"));
        continue;
    }

    $title = sprintf("\nDay %s: %s", $d, $mainClass->title());
    printf("%s\n%s\n", $title, str_pad("", strlen($title) - 1, "-"));
    printf("\tPart One: %s\n", $mainClass->partOne());
    printf("\tPart Two: %s\n", $mainClass->partTwo());
}

$stats = [
        "Memory (MB)" => memory_get_peak_usage(true) / 1048576.0,
        "Runtime (s)" => microtime(true) - START_TIME,
];

echo "\n\nStats\n-----\n";
foreach ($stats as $k => $v) {
    printf("% 16s: %1.4f\n", $k, $v);
}

