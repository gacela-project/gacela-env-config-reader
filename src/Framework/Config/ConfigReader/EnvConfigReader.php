<?php

declare(strict_types=1);

namespace Gacela\Framework\Config\ConfigReader;

use Gacela\Framework\Config\ConfigReaderInterface;
use Gacela\Framework\Event\ConfigReader\ReadEnvConfigEvent;
use Gacela\Framework\Event\Dispatcher\EventDispatchingCapabilities;
use Symfony\Component\Dotenv\Dotenv;

final class EnvConfigReader implements ConfigReaderInterface
{
    use EventDispatchingCapabilities;

    /**
     * @return array<string,mixed>
     */
    public function read(string $absolutePath): array
    {
        if (!$this->canRead($absolutePath)) {
            return [];
        }

        self::dispatchEvent(new ReadEnvConfigEvent($absolutePath));

        $env = new Dotenv();
        $env->load($absolutePath);

        /** @var array<string,mixed> $_ENV */
        return $_ENV;
    }

    private function canRead(string $absolutePath): bool
    {
        return false !== strpos($absolutePath, '.env')
            && file_exists($absolutePath);
    }
}
