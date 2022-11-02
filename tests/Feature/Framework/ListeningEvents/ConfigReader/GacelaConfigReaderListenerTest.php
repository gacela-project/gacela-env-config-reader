<?php

declare(strict_types=1);

namespace GacelaTest\Feature\Framework\ListeningEvents\ConfigReader;

use Gacela\Framework\Bootstrap\GacelaConfig;
use Gacela\Framework\Config\ConfigReader\EnvConfigReader;
use Gacela\Framework\Event\ConfigReader\ReadEnvConfigEvent;
use Gacela\Framework\Event\GacelaEventInterface;
use Gacela\Framework\Gacela;
use PHPUnit\Framework\TestCase;

final class GacelaConfigReaderListenerTest extends TestCase
{
    /** @var list<GacelaEventInterface> */
    private static array $inMemoryEvents = [];

    protected function setUp(): void
    {
        self::$inMemoryEvents = [];
    }

    public function test_two_yaml_config_files(): void
    {
        Gacela::bootstrap(__DIR__, function (GacelaConfig $config): void {
            $config->addAppConfig('config/.env*', '', EnvConfigReader::class);
            $config->resetInMemoryCache();
            $config->registerSpecificListener(ReadEnvConfigEvent::class, [$this, 'saveInMemoryEvent']);
        });

        self::assertEquals([
            new ReadEnvConfigEvent(__DIR__ . '/config/.env'),
            new ReadEnvConfigEvent(__DIR__ . '/config/.env.local'),
        ], self::$inMemoryEvents);
    }

    public function test_no_php_config_files(): void
    {
        Gacela::bootstrap(__DIR__, function (GacelaConfig $config): void {
            $config->addAppConfig('config/*.php');
            $config->resetInMemoryCache();
            $config->registerSpecificListener(ReadEnvConfigEvent::class, [$this, 'saveInMemoryEvent']);
        });

        self::assertEmpty(self::$inMemoryEvents);
    }

    public function saveInMemoryEvent(GacelaEventInterface $event): void
    {
        self::$inMemoryEvents[] = $event;
    }
}
