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

namespace Ramsey\Uuid\Console;

use Ramsey\Uuid\Console\Util;
use Ramsey\Uuid\Uuid;
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
        parent::__construct('ramsey/uuid-console', '1.0');
    }
}
