# Gacela EnvConfigReader

Load .env configuration files for your Gacela projects.

```bash
composer require gacela-project/gacela-env-config-reader
```

## Setup

You can define the reader configuration either in the `Gacela::bootstrap()` or in a `gacela.php` file.

### Option A)

Define the configuration in a `gacela.php` file in the root of your project (recommended way):

```php
<?php # gacela.php

use Gacela\Framework\Config\ConfigReader\EnvConfigReader;

return (new SetupGacela())
    ->setConfig(static function(ConfigBuilder $configBuilder): void {
        $configBuilder->add('config/.env*', 'config/.env.local.dist', EnvConfigReader::class);
    });
```

### Option B)

Define all configuration on the fly in the bootstrap itself.

```php
<?php  # public/index.php

use Gacela\Framework\Config\ConfigReader\EnvConfigReader;

$setup = (new SetupGacela())
    ->setConfig(static function(ConfigBuilder $configBuilder): void {
        $configBuilder->add('config/.env*', 'config/.env.local', EnvConfigReader::class);
    });

Gacela::bootstrap($appRootDir, $setup);
```

#### You can define more than one `ConfigReader` at once.

```php
static function(ConfigBuilder $configBuilder): void {
    $configBuilder->add('config/.env*', 'config/.env.local.dist', EnvConfigReader::class);
    $configBuilder->add('config/*.php', 'config/local.php');
    $configBuilder->add('config/*.custom', '', CustomConfigReader::class);
}
```
