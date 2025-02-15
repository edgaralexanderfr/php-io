<?php

declare(strict_types=1);

namespace PHPIO;

class Console
{
    public static function log(mixed ...$output): void
    {
        $output = implode(' ', array_map(fn($output) => print_r($output, true), $output));

        echo $output . PHP_EOL;
    }

    public static function write(mixed ...$output): void
    {
        $output = implode(' ', array_map(fn($output) => print_r($output, true), $output));

        echo $output;
    }

    public static function writeLine(mixed ...$output): void
    {
        $output = implode(' ', array_map(fn($output) => print_r($output, true), $output));

        echo $output . PHP_EOL;
    }

    public static function readLine(?string $prompt = null): string|false
    {
        return readline($prompt);
    }
}
