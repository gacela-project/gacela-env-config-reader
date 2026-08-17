# Changelog

## Unreleased

**Breaking for consumers.** This release moves the package onto Gacela 2.x and drops every PHP version below 8.3. An application that cannot take both of those cannot take this release; stay on `0.3`, which works against Gacela 1.x.

### Changed

- **Requires `gacela-project/gacela: ^2.4`** (was `>=1.7`). The old constraint resolved against every 1.x *and* every 2.x without the package ever having been tested against 2.x — a compatibility claim nothing backed. It is now an exact one
- **Requires PHP `>=8.3`** (was `>=8.0`), because Gacela 2.x does. `config.platform.php` moved to `8.3.16` to match
- **Widened `symfony/dotenv` to `^6.4 || ^7.0 || ^8.0`** (was `^v6.4`). Only `Dotenv::load()` is used and its signature is the same across all three, so pinning one major only forced a conflict on applications that had already chosen a different one
- `EnvConfigReader` allocates `ReadEnvConfigEvent` only when a listener is registered for it, guarding the dispatch with `shouldDispatch()` as Gacela's own `PhpConfigReader` does. No observable change: an unlistened event was dispatched into nothing before

Nothing changed in the public surface. `EnvConfigReader::class` is registered through `addAppConfig()` exactly as before, `ReadEnvConfigEvent` keeps its constructor, `absolutePath()` and `toString()` output, and no code in a consuming application needs to change beyond its own Gacela and PHP bumps.

### Fixed

- The `tests` CI job ran `phpunit --testsuite integration`, a suite this package has never declared, so it exercised nothing. It runs `unit,feature` now — the suites that actually boot Gacela and read a `.env`

### Development

- PHPUnit `^11.5 || ^12.0`, PHPStan `^2.0`, Psalm `^6.16`, php-cs-fixer `^3.95`; `phpunit.xml` migrated to the current schema and set to fail on warnings, notices and deprecations
- CI runs the suite on PHP 8.3, 8.4 and 8.5, and the static analysis on 8.3
