<?php

declare(strict_types=1);

namespace GacelaTest\Integration\Framework\UsingEnvConfigFromBootstrap\LocalConfig;

use Gacela\Framework\AbstractConfig;

final class Config extends AbstractConfig
{
    public function getArrayConfig(): array
    {
        return [
            'env_config' => $this->get('CONFIG_ENV'),
            'env_local_config' => $this->get('CONFIG_ENV_LOCAL'),
            'override' => $this->get('OVERRIDE'),
        ];
    }
}
