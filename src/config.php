<?php

declare(strict_types=1);

if (!defined('APP')) {
    $working_directory = getcwd();
    $directory = $working_directory;
    $config_file_found = false;

    do {
        $config_file_path = "{$directory}/phppp.json";

        if (file_exists($config_file_path)) {
            $config_file_found = true;

            break;
        }

        $directory = realpath("{$directory}/../");
    } while ($directory != '/');

    if ($config_file_found) {
        define('APP', $directory);
    } else if (isset($_SERVER['DOCUMENT_ROOT']) && !empty($_SERVER['DOCUMENT_ROOT'])) {
        define('APP', $_SERVER['DOCUMENT_ROOT']);
    } else {
        define('APP', $working_directory);
    }
}
