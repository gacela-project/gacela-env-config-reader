<?php

declare(strict_types=1);

namespace GacelaTest\Feature\Framework\UsingMultipleConfigTypesFromGacelaFile;

use Gacela\Framework\Bootstrap\GacelaConfig;
use Gacela\Framework\Config\ConfigReader\EnvConfigReader;
use Gacela\Framework\Gacela;
use PHPUnit\Framework\TestCase;

final class IntegrationTest extends TestCase
{
    public function setUp(): void
    {
        Gacela::bootstrap(__DIR__, static function (GacelaConfig $config): void {
            $config->resetInMemoryCache();
            $config->addAppConfig('config/*.php');
            $config->addAppConfig('config/.env*', 'config/.env.local.dist', EnvConfigReader::class);
        });
    }

    public function test_read_config_values_env_from_gacela_file(): void
    {
        $facade = new LocalConfig\Facade();

        self::assertSame(
            [
                'env_config' => 'ENV_CONFIG',
                'env_local_config' => 'ENV_LOCAL_CONFIG',
                'php_config' => 'PHP_CONFIG',
                'override' => 'ENV_LOCAL_OVERRIDE',
            ],
            $facade->doSomething()
        );
    }
}
