<?php

declare(strict_types=1);

namespace Gacela\Framework\Event\ConfigReader;

use Gacela\Framework\Event\GacelaEventInterface;

use function sprintf;

final class ReadEnvConfigEvent implements GacelaEventInterface
{
    public function __construct(
        private readonly string $absolutePath,
    ) {
    }

    public function absolutePath(): string
    {
        return $this->absolutePath;
    }

    public function toString(): string
    {
        return sprintf(
            '%s - %s',
            self::class,
            $this->absolutePath,
        );
    }
}
