<?php

declare(strict_types=1);

namespace GacelaTest\Feature\Framework\UsingMultipleConfigTypesFromGacelaFile\LocalConfig;

use Gacela\Framework\AbstractConfig;

final class Config extends AbstractConfig
{
    public function getArrayConfig(): array
    {
        return [
            'env_config' => $this->get('CONFIG_ENV'),
            'env_local_config' => $this->get('CONFIG_ENV_LOCAL'),
            'php_config' => $this->get('CONFIG_PHP'),
            'override' => $this->get('OVERRIDE'),
        ];
    }
}
