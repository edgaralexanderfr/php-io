<?php

declare(strict_types=1);

// Check and `define` `global` configuration from repositories:
if (!defined('PHPPP_CONFIG')) {
    $working_directory = getcwd();
    $directory = $working_directory;
    $config_file_found = false;

    /** @todo We gotta handle Windows case in here... */
    do {
        $config_file_path = "{$directory}/phppp.json";

        if (file_exists($config_file_path)) {
            $config_file_found = true;

            break;
        }

        $directory = realpath("{$directory}/../");
    } while ($directory != '/');

    if (!$config_file_found || !is_object($config = json_decode((string) file_get_contents($config_file_path)))) {
        $config = (object)[];
    }

    define('PHPPP_CONFIG', $config);

    if ($config_file_found) {
        define('PHPPP_CONFIG_PATH', $directory);
    }
}

// Define `PHPIO` configs:

if (!defined('APP')) {
    if (defined('PHPPP_CONFIG_PATH')) {
        define('APP', PHPPP_CONFIG_PATH);
    } else if (isset($_SERVER['DOCUMENT_ROOT']) && !empty($_SERVER['DOCUMENT_ROOT'])) {
        define('APP', $_SERVER['DOCUMENT_ROOT']);
    } else {
        define('APP', getcwd());
    }
}

$ini = PHPPP_CONFIG?->io?->ini ?? (object)[];

if (is_object($ini)) {
    foreach ($ini as $option => $value) {
        ini_set($option, $value);
    }
}

$ignore_main = PHPPP_CONFIG->io?->config?->ignore_main ?? false;
$colorize = PHPPP_CONFIG?->io?->config?->console?->colorize ?? null;

if (!defined('PHPIO_IGNORE_MAIN')) {
    define('PHPIO_IGNORE_MAIN', $ignore_main ? true : false);
}

if (is_bool($colorize)) {
    \PHPIO\Console::colorize($colorize);
}

// `unset` `global` `PHPIO` variables:

unset($colorize);
unset($value);
unset($option);
unset($ini);

// `unset` `global` variables from repositories:

unset($config);
unset($directory);
unset($config_file_found);
unset($config_file_path);
unset($working_directory);
