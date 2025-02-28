<?php

declare(strict_types=1);

namespace PHPIO;

final class Console
{
    private static bool $colorize = true;

    public static function colorize(bool $colorize = true): void
    {
        self::$colorize = $colorize;
    }

    public static function echo(mixed ...$output): void
    {
        $output = concat(...$output);

        echo $output . PHP_EOL;
    }

    public static function write(mixed ...$output): void
    {
        $output = concat(...$output);

        echo $output;
    }

    public static function writeln(mixed ...$output): void
    {
        $output = concat(...$output);

        echo $output . PHP_EOL;
    }

    public static function writeLine(mixed ...$output): void
    {
        $output = concat(...$output);

        echo $output . PHP_EOL;
    }

    public static function log(mixed ...$output): void
    {
        $output_string = concat(...$output);

        if (!self::$colorize || System::isWindows()) {
            $output = $output_string;
        } else {
            $output = "ℹ️ \033[36m{$output_string}\033[0m";
        }

        echo $output . PHP_EOL;
    }

    public static function warn(mixed ...$output): void
    {
        $output_string = concat(...$output);

        if (!self::$colorize || System::isWindows()) {
            $output = $output_string;
        } else {
            $output = "🟡 \033[33m{$output_string}\033[0m";
        }

        echo $output . PHP_EOL;
    }

    public static function error(mixed ...$output): void
    {
        $output_string = concat(...$output);

        if (!self::$colorize || System::isWindows()) {
            $output = $output_string;
        } else {
            $output = "⛔ \033[31m{$output_string}\033[0m";
        }

        echo $output . PHP_EOL;
    }

    public static function readln(?string $prompt = null): string|false
    {
        return readline($prompt);
    }

    public static function readLine(?string $prompt = null): string|false
    {
        return readline($prompt);
    }
}
