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
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

use function method_exists;

class V7Formatter implements UuidContentFormatterInterface
{
    /**
     * @inheritDoc
     */
    public function getContent(UuidInterface $uuid): array
    {
        if (method_exists(Uuid::class, 'uuid7')) {
            $time = $uuid->getDateTime()->format('c');
        } else {
            $time = 'Not supported in this version of ramsey/uuid';
        }

        return [
            ['', 'content:', 'time:  ' . $time],
        ];
    }
}
