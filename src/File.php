<?php

declare(strict_types=1);

namespace PHPIO;

/**
 * @property string|false $content
 */
class File implements \Stringable
{
    public readonly string $path;
    public string|false $full_path;

    private string|false|null $cached_content = null;

    public function __construct(Path|string $path)
    {
        if ($path instanceof Path) {
            $this->path = $path->path;
            $this->full_path = $path->full_path;
        } else {
            $this->path = $path;
            $this->full_path = realpath($path);
        }
    }

    public function getContent(bool $use_include_path = false, $context = null, int $offset = 0, ?int $length = null): string|false
    {
        return file_get_contents($this->path, $use_include_path, $context, $offset, $length);
    }

    public function __toString(): string
    {
        return $this->content;
    }

    /** @disregard */
    public string|false $content
    {
        /** @disregard */
        get {
            if ($this->cached_content === null) {
                $this->cached_content = $this->getContent();
            }

            return $this->cached_content;
        }
    }
}
