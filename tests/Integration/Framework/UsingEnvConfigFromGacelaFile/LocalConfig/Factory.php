<?php

declare(strict_types=1);

namespace GacelaTest\Integration\Framework\UsingEnvConfigFromGacelaFile\LocalConfig;

use Gacela\Framework\AbstractFactory;

/**
 * @method Config getConfig()
 */
final class Factory extends AbstractFactory
{
    public function getArrayConfig(): array
    {
        return $this->getConfig()->getArrayConfig();
    }
}