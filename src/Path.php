<?php

declare(strict_types=1);

namespace PHPIO;

/**
 * @property array|false $files
 */
class Path implements \Iterator, \Stringable
{
    public string|false $full_path;

    private array|false|null $cached_files = null;
    private array|null $walker = null;

    public function __construct(
        public readonly string $path,
        public bool $exclude_parent_dirs = true,
        public bool $full_paths = false,
    ) {
        $this->full_path = realpath($path);
    }

    /**
     * @param ?resource $context
     */
    public function ls(int $sorting_order = SCANDIR_SORT_ASCENDING, $context = null): array|false
    {
        $dir = scandir($this->path);

        return $dir;
    }

    public function __toString(): string
    {
        return format(output: $this->full_path);
    }

    public function rewind(): void
    {
        if ($this->walker === null) {
            $this->walker = ($this->files) ? $this->files : [];
        }

        reset($this->walker);
    }

    #[\ReturnTypeWillChange]
    public function current(): mixed
    {
        return current($this->walker);
    }

    #[\ReturnTypeWillChange]
    public function key(): mixed
    {
        return key($this->walker);
    }

    public function next(): void
    {
        next($this->walker);
    }

    public function valid(): bool
    {
        return key($this->walker) !== null;
    }

    /** @disregard */
    public array|false $files
    {
        /** @disregard */
        get {
            if ($this->cached_files === null) {
                $this->cached_files = $this->ls();
            }

            if ($this->cached_files === false) {
                return $this->cached_files;
            }

            $files = [];

            foreach ($this->cached_files as $file) {
                if ($this->exclude_parent_dirs && ($file == '.' || $file == '..')) {
                    continue;
                }

                if ($this->full_paths) {
                    $files[] = realpath("{$this->path}/{$file}");
                } else {
                    $files[] = $file;
                }
            }

            return $files;
        }
    }
}
