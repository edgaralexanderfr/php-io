<?php

declare(strict_types=1);

if (!function_exists('import')) {
    function import(string $path): void
    {
        $file_path = $path;

        if (defined('PHPIO_ADD_LEADING_SLASH') && PHPIO_ADD_LEADING_SLASH) {
            $file_path = DIRECTORY_SEPARATOR . $file_path;
        }

        if (defined('PHPIO_ADD_PHP_EXTENSION') && PHPIO_ADD_PHP_EXTENSION) {
            $file_path .= '.php';
        }

        require_once APP . $file_path;
    }
}
