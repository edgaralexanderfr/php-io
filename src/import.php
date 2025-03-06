<?php

declare(strict_types=1);

if (!function_exists('import')) {
    function import(string $file_path): void
    {
        require_once APP . $file_path;
    }
}
