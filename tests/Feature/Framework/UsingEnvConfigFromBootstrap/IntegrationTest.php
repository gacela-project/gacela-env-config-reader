<?php

declare(strict_types=1);

namespace GacelaTest\Feature\Framework\UsingEnvConfigFromBootstrap;

use Gacela\Framework\Bootstrap\GacelaConfig;
use Gacela\Framework\Config\ConfigReader\EnvConfigReader;
use Gacela\Framework\Gacela;
use PHPUnit\Framework\TestCase;

final class IntegrationTest extends TestCase
{
    public function setUp(): void
    {
        Gacela::bootstrap(__DIR__, static function (GacelaConfig $config): void {
            $config->addAppConfig('config/.env*', 'config/.env.local.dist', EnvConfigReader::class);
        });
    }

    public function test_read_config_values_env_from_bootstrap(): void
    {
        $facade = new LocalConfig\Facade();

        self::assertSame(
            [
                'env_config' => 'ENV_CONFIG',
                'env_local_config' => 'ENV_LOCAL_CONFIG',
                'override' => 'ENV_LOCAL_OVERRIDE',
            ],
            $facade->doSomething()
        );
    }
}
