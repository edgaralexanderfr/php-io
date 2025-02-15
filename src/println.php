<?php

declare(strict_types=1);

namespace PHPIO;

function println(mixed ...$output): void
{
    $output = implode(' ', array_map(fn($output) => print_r($output, true), $output));

    echo $output . PHP_EOL;
}
