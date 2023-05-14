<?php

declare(strict_types=1);

namespace GacelaTest\Unit\Framework\Event\ConfigReader;

use Gacela\Framework\Event\ConfigReader\ReadEnvConfigEvent;
use PHPUnit\Framework\TestCase;

final class ReadEnvConfigEventTest extends TestCase
{
    public function test_absolute_path(): void
    {
        $event = new ReadEnvConfigEvent(__DIR__);

        self::assertSame(__DIR__, $event->absolutePath());
    }

    public function test_config_event_to_string(): void
    {
        $event = new ReadEnvConfigEvent(__DIR__);

        $expected = ReadEnvConfigEvent::class . ' - ' . __DIR__;
        self::assertSame($expected, $event->toString());
    }
}
