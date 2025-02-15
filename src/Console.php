<?php

declare(strict_types=1);

namespace PHPIO;

class Console
{
    public static function echo(mixed ...$output): void
    {
        $output = concat(...$output);

        echo $output . PHP_EOL;
    }

    public static function log(mixed ...$output): void
    {
        $output = concat(...$output);

        echo $output . PHP_EOL;
    }

    public static function write(mixed ...$output): void
    {
        $output = concat(...$output);

        echo $output;
    }

    public static function writeLine(mixed ...$output): void
    {
        $output = concat(...$output);

        echo $output . PHP_EOL;
    }

    public static function readLine(?string $prompt = null): string|false
    {
        return readline($prompt);
    }
}
