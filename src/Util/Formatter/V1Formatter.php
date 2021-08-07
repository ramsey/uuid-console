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

namespace Ramsey\Uuid\Console\Util\Formatter;

use Ramsey\Uuid\Console\Util\UuidFormatter;
use Ramsey\Uuid\UuidInterface;
use Ramsey\Uuid\Console\Util\UuidContentFormatterInterface;

class V1Formatter implements UuidContentFormatterInterface
{
    public function getContent(UuidInterface $uuid)
    {
        return array(
            array('', 'content:', 'time:  ' . $uuid->getDateTime()->format('c')),
            array('', '', 'clock: ' . $uuid->getClockSequence() . ' (usually random)'),
            array('', '', 'node:  ' . substr(chunk_split($uuid->getNodeHex(), 2, ':'), 0, -1)),
        );
    }
}
