<?php

declare(strict_types=1);

namespace PHPIO;

final class std
{
    private static bool $is_cli = false;

    public static function init()
    {
        self::$is_cli = !http_response_code();
    }

    public static function pout(string $output, string $emoji = '', string $color = ''): void
    {
        $pout = '';

        if ($emoji != '') {
            $pout .= "{$emoji} ";
        }

        if (self::$is_cli) {
            if ($color == '') {
                $pout .= $output;
            } else {
                $pout .= "\033[{$color}m{$output}\033[0m";
            }

            echo $pout;
        } else {
            $pout .= $output;

            file_put_contents(APP . '/phppp-log.txt', $pout, FILE_APPEND);
        }
    }
}

std::init();
