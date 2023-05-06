<?php

declare(strict_types=1);

namespace GacelaTest\Feature\Framework\UsingEnvConfigFromBootstrap\LocalConfig;

use Gacela\Framework\AbstractConfig;

final class Config extends AbstractConfig
{
    public function getArrayConfig(): array
    {
        return [
            'env_config' => $this->get('CONFIG_ENV', 'default-env_config'),
            'env_local_config' => $this->get('CONFIG_ENV_LOCAL', 'default-env_local_config'),
            'override' => $this->get('OVERRIDE', 'default-override'),
        ];
    }
}
