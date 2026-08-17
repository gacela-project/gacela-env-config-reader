# Gacela EnvConfigReader

Load .env configuration files for your Gacela projects.

```bash
composer require gacela-project/gacela-env-config-reader
```

## Requirements

| | |
|---|---|
| PHP | `>=8.3` |
| `gacela-project/gacela` | `^2.4` |
| `symfony/dotenv` | `^6.4 \|\| ^7.0 \|\| ^8.0` |

Gacela 2.0 raised its own PHP floor to 8.3, so this package cannot be used on an
older runtime. If your application is still on Gacela 1.x or PHP 8.0–8.2, stay on
version `0.3` of this package — see [Gacela's upgrade
guide](https://github.com/gacela-project/gacela/blob/main/UPGRADE.md) for what
moving to 2.x involves.

## Setup

You can define the reader configuration either in the `Gacela::bootstrap()` or in a `gacela.php` file.

### Option A)

Define the configuration in a `gacela.php` file in the root of your project (recommended way):

```php
<?php # gacela.php

use Gacela\Framework\Bootstrap\GacelaConfig;
use Gacela\Framework\Config\ConfigReader\EnvConfigReader;

return static function (GacelaConfig $config): void {
    $config->addAppConfig('config/.env*', 'config/.env.local.dist', EnvConfigReader::class);
};
```

### Option B)

Define all configuration on the fly in the bootstrap itself.

```php
<?php  # public/index.php

use Gacela\Framework\Bootstrap\GacelaConfig;
use Gacela\Framework\Config\ConfigReader\EnvConfigReader;
use Gacela\Framework\Gacela;

$config = static function (GacelaConfig $config): void {
    $config->addAppConfig('config/.env*', 'config/.env.local.dist', EnvConfigReader::class);
};

Gacela::bootstrap($appRootDir, $config);
```

#### You can define more than one `ConfigReader` at once.

```php
$config = static function (GacelaConfig $config): void {
    $config->addAppConfig('config/.env*', 'config/.env.local.dist', EnvConfigReader::class);
    $config->addAppConfig('config/*.php', 'config/local.php');
    $config->addAppConfig('config/*.custom', '', CustomConfigReader::class);
}
```
