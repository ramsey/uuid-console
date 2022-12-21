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

namespace Ramsey\Uuid\Console\Util\Formatter;

use Ramsey\Uuid\Console\Util\UuidContentFormatterInterface;
use Ramsey\Uuid\UuidInterface;

use function chunk_split;
use function hexdec;
use function substr;

class V1Formatter implements UuidContentFormatterInterface
{
    /**
     * @inheritDoc
     */
    public function getContent(UuidInterface $uuid): array
    {
        return [
            ['', 'content:', 'time:  ' . $uuid->getDateTime()->format('c')],
            ['', '', 'clock: ' . hexdec($uuid->getClockSequenceHex()) . ' (usually random)'],
            ['', '', 'node:  ' . substr(chunk_split($uuid->getNodeHex(), 2, ':'), 0, -1)],
        ];
    }
}
