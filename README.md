# Gacela EnvConfigReader

Load .env configuration files.

You must set the Config Readers in the bootstrap of your application
```php
Config::setConfigReaders([
    'env' => new EnvConfigReader(),
    // ...
]);
```

## Installation

```bash
composer require gacela-project/gacela-env-config-reader
```
