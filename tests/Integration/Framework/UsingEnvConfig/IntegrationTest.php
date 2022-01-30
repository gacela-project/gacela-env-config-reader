<?php

declare(strict_types=1);

namespace GacelaTest\Integration\Framework\UsingEnvConfig;

use Gacela\Framework\Config;
use Gacela\Framework\Config\ConfigReader\EnvConfigReader;
use PHPUnit\Framework\TestCase;

final class IntegrationTest extends TestCase
{
    public function setUp(): void
    {
        Config::setConfigReaders([
            'env' => new EnvConfigReader(),
        ]);
        Config::getInstance()->setApplicationRootDir(__DIR__);
    }

    public function test_read_config_values_env(): void
    {
        $facade = new LocalConfig\Facade();

        self::assertSame(
            [
                'config' => 1,
                'config_local' => 2,
                'override' => 5,
            ],
            $facade->doSomething()
        );
    }
}
