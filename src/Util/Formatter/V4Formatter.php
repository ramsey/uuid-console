<?php

/**
 * This file is part of the ramsey/uuid-console application
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @link https://packagist.org/packages/ramsey/uuid-console Packagist
 * @link https://github.com/ramsey/uuid-console GitHub
 *
 * @copyright Copyright (c) Ben Ramsey <ben@benramsey.com>
 * @license http://opensource.org/licenses/MIT MIT
 */

declare(strict_types=1);

namespace Ramsey\Uuid\Console\Util\Formatter;

use Ramsey\Uuid\Console\Util\UuidContentFormatterInterface;
use Ramsey\Uuid\UuidInterface;

use function chunk_split;
use function substr;

class V4Formatter implements UuidContentFormatterInterface
{
    /**
     * @inheritDoc
     */
    public function getContent(UuidInterface $uuid): array
    {
        return [
            ['', 'content:', substr(chunk_split((string) $uuid->getHex(), 2, ':'), 0, -1)],
            ['', '', '(no semantics: random data only)'],
        ];
    }
}
