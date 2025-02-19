# PHP IO 🐘

⚠️ **Note:** This documentation is inaccurate and under redaction and needs to be corrected.

##### Table of contents 📖

1. [Usage](#usage)

- [1.1 The `main()` function](#the-main-function)
- - [1.1.1 Defining a `main` function](#defining-a-main-function)
- - [1.1.2 `main` function arguments](#main-function-arguments)
- - [1.1.3 Ignore `main` function call](#ignore-main-function-call)

<a name="the-main-function"></a>

### The `main()` function

<a name="defining-a-main-function"></a>

#### Defining a `main` function

Just like in a traditional **C-Program**, you can define a `main` `function` as your _program entrypoint_ optionally:

```php
<?php

declare(strict_types=1);

include 'vendor/autoload.php';

function main()
{
    echo 'Hello world!' . PHP_EOL;
}
```

```bash
php examples/main.php
Hello world!
```

This helps you to aim for a more organized code structure for your program, especially if you're writing command-line programs.

<a name="main-function-arguments"></a>

#### `main` function arguments

You can also receive command-line arguments directly from the `main` `function`:

```php
<?php

declare(strict_types=1);

include 'vendor/autoload.php';

use PHPTypes\Primitive\string_array;

function main(int $argc, string_array $argv): int
{
    printf("argc: %d\n", $argc);
    printf("argv: %s\n", print_r($argv, true));

    system("read -n 1 -s -p \"Press any key to continue...\"");

    return 0;
}
```

```bash
php examples/main_args.php
argc: 1
argv: PHPTypes\Primitive\string_array Object
(
    [type:protected] => string
    [storage:ArrayIterator:private] => Array
        (
            [0] => examples/main_args.php
        )

)

Press any key to continue...
```

And you can also `return` the _status code_ as the result of your program execution:

```bash
echo $?
0
```

<a name="ignore-main-function-call"></a>

#### Ignore `main` function call

`main` functions are only called in case they're defined in your script, however, in case you want to skip the process 100% and avoid calling the `register_shutdown_function` for the purpose, you can define a `PHPTYPES_IGNORE_MAIN` `constant` _right before_ including the **PHP Types** library or the respective _autoload.php_ file you're including.

```php
<?php

declare(strict_types=1);

define('PHPTYPES_IGNORE_MAIN', true);

include 'vendor/autoload.php';

function main(): int
{
    echo 'This is not executed' . PHP_EOL;

    return 0;
}

echo 'This is executed' . PHP_EOL;
```

```bash
php examples/main_ignore.php
This is executed
```

In case you define the `PHPTYPES_IGNORE_MAIN` `constant` after including the library or the autoload file, the `register_shutdown_function` _will still be called_, but the `main` `function` will still be ignored.
