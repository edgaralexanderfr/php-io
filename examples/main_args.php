<?php

declare(strict_types=1);

include 'vendor/autoload.php';

use PHPTypes\Primitive\string_array;

function main(int $argc, string_array $argv): int
{
    printf("argc: %d\n", $argc);
    printf("argv: %s\n", print_r($argv, true));

    system("read -n 1 -s -p \"Press any key to continue...\"");

    return 0;
}
