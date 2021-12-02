<?php

declare(strict_types=1);

namespace Ramsey\Uuid\Console\Util;

use ErrorException;
use Ramsey\Uuid\Console\TestCase;
use Throwable;

use function error_reporting;
use function set_error_handler;

use const E_ALL;

class ErrorHandlerTest extends TestCase
{
    public function testRegister(): void
    {
        $expected = [ErrorHandler::class, 'handle'];

        $originalHandler = set_error_handler(fn (int $i, string $x, string $z, int $n): bool => true);

        ErrorHandler::register();
        $testHandler = set_error_handler(fn (int $i, string $x, string $z, int $n): bool => true);

        // Set handler back to original
        set_error_handler($originalHandler);

        $this->assertSame($expected, $testHandler);
    }

    public function testHandle(): void
    {
        $this->expectException(ErrorException::class);
        $this->expectExceptionMessage('Test exception');

        error_reporting(E_ALL);
        ErrorHandler::handle(1, 'Test exception', __FILE__, __LINE__);
    }

    public function testHandleNoException(): void
    {
        error_reporting(0);

        try {
            ErrorHandler::handle(1, 'Test exception', __FILE__, __LINE__);
        } catch (Throwable $exception) {
            $this->fail('Caught an unexpected exception');
        }

        $this->assertTrue(true);
    }
}
