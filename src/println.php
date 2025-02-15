<?php

declare(strict_types=1);

namespace PHPIO;

function println(mixed ...$output): void
{
    $output = concat(...$output);

    echo $output . PHP_EOL;
}
