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

namespace Ramsey\Uuid\Console;

use Symfony\Component\Console\Application as BaseApplication;

/**
 * The console application that handles CLI commands
 */
class Application extends BaseApplication
{
    /**
     * Constructor
     */
    public function __construct()
    {
        Util\ErrorHandler::register();
        parent::__construct('ramsey/uuid-console', '1.1');
    }
}
