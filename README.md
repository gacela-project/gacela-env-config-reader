# Gacela EnvConfigReader

Load .env configuration files for your Gacela projects.

```bash
composer require gacela-project/gacela-env-config-reader
```

## Setup

You must define in the `Gacela::bootstrap()` the configuration for the `env` files.

- The first parameter refers to the `$rootAppDir`
- The second parameter refers to the `$globalServices`, you can define the settings in an external `gacela.php` file
  (recommended way) or inline
- The third parameter refers to the `$configReaders`, the key should match with the `$globalServices['config']['type']`,
  additionally, the parameter is an array because you can define more than one reader

### Option A)

Define the `ConfigReader` in your bootstrap

```php
use Gacela\Framework\Config\ConfigReader\EnvConfigReader;

Gacela::bootstrap(__DIR__, [], ['env' => new EnvConfigReader()]);
```

And set the configuration in a `gacela.php` file in the root of your project:

```php
<?php # gacela.php
use Gacela\Framework\AbstractConfigGacela;

return static fn () => new class() extends AbstractConfigGacela {
    public function config(): array
    {
        return [
            'type' => 'env',
            'path' => 'config/.env*',
            'path_local' => 'config/.env.local.dist',
        ];
    }
};
```

### Option B)

Define all configuration on the fly in the bootstrap itself.

```php
use Gacela\Framework\Config\ConfigReader\EnvConfigReader;

Gacela::bootstrap(
    __DIR__,
    [
        'config' => [
            [
                'type' => 'env',
                'path' => 'config/.env*',
                'path_local' => 'config/.env.local.dist',
            ],
        ],
    ],
    ['env' => new EnvConfigReader]
);
```

### You can define more than one `ConfigReader` at once.

```php
use Gacela\Framework\Config\ConfigReader\PhpConfigReader;
use Gacela\Framework\Config\ConfigReader\EnvConfigReader;

$globalServices = [
    'config' => [
        [
            'type' => 'php',
            'path' => 'config/*.php',
            'path_local' => 'config/local.php',
        ],
        [
            'type' => 'env',
            'path' => 'config/.env*',
            'path_local' => 'config/.env.local.dist',
        ],
    ],
];

$configReaders = [
    'php' => new PhpConfigReader(),
    'env' => new EnvConfigReader(),
];

Gacela::bootstrap(__DIR__, $globalServices, $configReaders);
```
