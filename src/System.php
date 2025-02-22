<?php

declare(strict_types=1);

namespace PHPIO;

class System
{
    public static function pause(string $message = "Press any key to continue...\n"): void
    {
        static $is_windows;

        if ($is_windows === null) {
            $is_windows = str_contains(PHP_OS, 'WIN');
            echo 'only once' . PHP_EOL;
        }

        if ($is_windows) {
            system('pause');
        } else {
            system("read -n 1 -s -p \"{$message}\"");
        }
    }
}
