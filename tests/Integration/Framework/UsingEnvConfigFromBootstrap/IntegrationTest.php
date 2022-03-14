<?php

declare(strict_types=1);

namespace GacelaTest\Integration\Framework\UsingEnvConfigFromBootstrap;

use Gacela\Framework\Config\ConfigReader\EnvConfigReader;
use Gacela\Framework\Config\GacelaConfigBuilder\ConfigBuilder;
use Gacela\Framework\Gacela;
use PHPUnit\Framework\TestCase;

final class IntegrationTest extends TestCase
{
    public function setUp(): void
    {
        Gacela::bootstrap(__DIR__, [
            'config' => static function (ConfigBuilder $configBuilder): void {
                $configBuilder->add('config/.env*', 'config/.env.local.dist', EnvConfigReader::class);
            },
        ]);
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
