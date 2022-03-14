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

return fn () => new class() extends AbstractConfigGacela 
{
    public function config(ConfigBuilder $configBuilder): void
    {
        $configBuilder->add('config/.env', 'config/.env.local', EnvConfigReader::class);
    }
}
```

### Option B)

Define all configuration on the fly in the bootstrap itself.

```php
<?php  # public/index.php

Gacela::bootstrap($appRootDir, [
    'config' => function (ConfigBuilder $configBuilder): void {
        $configBuilder->add('config/.env*', 'config/.env.local', EnvConfigReader::class);
    }
]);
```

### You can define more than one `ConfigReader` at once.

```php
Gacela::bootstrap($appRootDir, [
    'config' => function (ConfigBuilder $configBuilder): void {
        $configBuilder->add('config/*.php', 'config/local.php');
        $configBuilder->add('config/.env*', 'config/.env.local.dist', EnvConfigReader::class);
    }
]);
```
