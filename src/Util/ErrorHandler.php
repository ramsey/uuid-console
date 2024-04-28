<?php

/**
 * This file is part of the ramsey/uuid-console application
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @copyright Copyright (c) Ben Ramsey <ben@benramsey.com>
 * @license http://opensource.org/licenses/MIT MIT
 */

declare(strict_types=1);

namespace Ramsey\Uuid\Console\Util;

use ErrorException;

use function error_reporting;
use function set_error_handler;

/**
 * Convert PHP errors into exceptions
 */
class ErrorHandler
{
    /**
     * Error handler
     *
     * @param int $level Level of the error raised
     * @param string $message Error message
     * @param string $file Filename that the error was raised in
     * @param int $line Line number the error was raised at
     *
     * @throws ErrorException
     */
    public static function handle(int $level, string $message, string $file, int $line): ?bool
    {
        // respect error_reporting being disabled
        if (!error_reporting()) {
            return null;
        }

        throw new ErrorException($message, 0, $level, $file, $line);
    }

    /**
     * Register error handler
     */
    public static function register(): void
    {
        /** @psalm-var callable(int, string, string=, int=, array<array-key, mixed>=):bool|null $callback */
        $callback = [self::class, 'handle'];

        set_error_handler($callback);
    }
}
