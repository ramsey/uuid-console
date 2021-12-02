<?php

declare(strict_types=1);

namespace Ramsey\Uuid\Console;

use function restore_error_handler;

class ApplicationTest extends TestCase
{
    public function testConstructor(): void
    {
        $app = new Application();

        // Reset the error handler, since the constructor sets it
        restore_error_handler();

        $this->assertInstanceOf(Application::class, $app);
        $this->assertSame('ramsey/uuid-console', $app->getName());
    }
}
