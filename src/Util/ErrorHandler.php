<?php
/**
 * This file is part of the ramsey/uuid-console application
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @copyright Copyright (c) Ben Ramsey <ben@benramsey.com>
 * @license http://opensource.org/licenses/MIT MIT
 * @link https://packagist.org/packages/ramsey/uuid-console Packagist
 * @link https://github.com/ramsey/uuid-console GitHub
 */

namespace Ramsey\Uuid\Console\Util;

/**
 * Convert PHP errors into exceptions
 */
class ErrorHandler
{
    /**
     * Error handler
     *
     * @param int    $level   Level of the error raised
     * @param string $message Error message
     * @param string $file    Filename that the error was raised in
     * @param int    $line    Line number the error was raised at
     *
     * @static
     * @throws \ErrorException
     */
    public static function handle($level, $message, $file, $line)
    {
        // respect error_reporting being disabled
        if (!error_reporting()) {
            return;
        }

        throw new \ErrorException($message, 0, $level, $file, $line);
    }

    /**
     * Register error handler
     *
     * @static
     */
    public static function register()
    {
        set_error_handler(array(__CLASS__, 'handle'));
    }
}
