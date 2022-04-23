<?php

declare(strict_types=1);

use Gacela\Framework\Config\ConfigReader\EnvConfigReader;
use Gacela\Framework\Config\GacelaConfigBuilder\ConfigBuilder;
use Gacela\Framework\Setup\SetupGacela;

return (new SetupGacela())
    ->setConfig(static function (ConfigBuilder $configBuilder): void {
        $configBuilder->add('config/*.php');
        $configBuilder->add('config/.env*', 'config/.env.local.dist', EnvConfigReader::class);
    });
