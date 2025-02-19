<?php

declare(strict_types=1);

define('PHPTYPES_IGNORE_MAIN', true);

include 'vendor/autoload.php';

function main(): int
{
    echo 'This is not executed' . PHP_EOL;

    return 0;
}

echo 'This is executed' . PHP_EOL;
