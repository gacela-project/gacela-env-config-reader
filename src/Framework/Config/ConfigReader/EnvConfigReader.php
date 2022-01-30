<?php

declare(strict_types=1);

namespace Gacela\Framework\Config\ConfigReader;

use Gacela\Framework\Config\ConfigReaderInterface;
use Symfony\Component\Dotenv\Dotenv;

final class EnvConfigReader implements ConfigReaderInterface
{
    public function canRead(string $absolutePath): bool
    {
        return false !== strpos($absolutePath, '.env');
    }

    /**
     * @return array<string,mixed>
     */
    public function read(string $absolutePath): array
    {
        if (!file_exists($absolutePath)) {
            return [];
        }

        $env = new Dotenv();
        $env->load($absolutePath);

        /** @var array<string,mixed> $_ENV */
        return $_ENV;
    }
}
