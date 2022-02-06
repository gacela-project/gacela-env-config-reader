<?php

declare(strict_types=1);

namespace GacelaTest\Integration\Framework\UsingMultipleConfigTypes;

use Gacela\Framework\Config\ConfigReader\EnvConfigReader;
use Gacela\Framework\Config\ConfigReader\PhpConfigReader;
use Gacela\Framework\Gacela;
use PHPUnit\Framework\TestCase;

final class IntegrationTest extends TestCase
{
    public function setUp(): void
    {
        Gacela::bootstrap(__DIR__, [], [
            'php' => new PhpConfigReader(),
            'env' => new EnvConfigReader(),
        ]);
    }

    public function test_read_config_values_env(): void
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
