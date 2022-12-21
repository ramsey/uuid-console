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

use Ramsey\Uuid\Codec\OrderedTimeCodec;
use Ramsey\Uuid\Console\Exception;
use Ramsey\Uuid\Console\Util\Formatter\V1Formatter;
use Ramsey\Uuid\Console\Util\Formatter\V2Formatter;
use Ramsey\Uuid\Console\Util\Formatter\V3Formatter;
use Ramsey\Uuid\Console\Util\Formatter\V4Formatter;
use Ramsey\Uuid\Console\Util\Formatter\V5Formatter;
use Ramsey\Uuid\Console\Util\Formatter\V6Formatter;
use Ramsey\Uuid\Console\Util\Formatter\V7Formatter;
use Ramsey\Uuid\Console\Util\Formatter\V8Formatter;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidFactory;
use Ramsey\Uuid\UuidInterface;
use Symfony\Component\Console\Helper\Table;

use function assert;

class UuidFormatter
{
    /**
     * @var array<int, string>
     */
    private static array $versionMap = [
        -1 => 'Unknown',
        1 => '1 (time and node based)',
        2 => '2 (DCE security based)',
        3 => '3 (name based, MD5)',
        4 => '4 (random data based)',
        5 => '5 (name based, SHA-1)',
        6 => '6 (reordered time)',
        7 => '7 (Unix Epoch time)',
        8 => '8 (custom)',
    ];

    /**
     * @var array<int, string>
     */
    private static array $variantMap = [
        -1 => 'Unknown',
        Uuid::RESERVED_NCS => 'Reserved',
        Uuid::RFC_4122 => 'RFC 4122',
        Uuid::RESERVED_MICROSOFT => 'Reserved for Microsoft use.',
        Uuid::RESERVED_FUTURE => 'Reserved for future use.',
    ];

    /**
     * @var array<int, UuidContentFormatterInterface | null> | null
     */
    private static ?array $formatters = null;

    public function __construct()
    {
        if (self::$formatters === null) {
            self::$formatters = [
                -1 => null,
                1 => new V1Formatter(),
                2 => new V2Formatter(),
                3 => new V3Formatter(),
                4 => new V4Formatter(),
                5 => new V5Formatter(),
                6 => new V6Formatter(),
                7 => new V7Formatter(),
                8 => new V8Formatter(),
            ];
        }
    }

    public function write(Table $table, UuidInterface $uuid): void
    {
        $integer = (string) $uuid->getInteger();

        /** @var array<string[]> $encodeRows */
        $encodeRows = [
            ['encode:', 'STR:', (string) $uuid],
            ['', 'INT:', $integer],
        ];

        if ($uuid->getVersion() === 1) {
            $factory = clone Uuid::getFactory();
            assert($factory instanceof UuidFactory);

            $codec = new OrderedTimeCodec($factory->getUuidBuilder());
            $encodeRows[] = ['', 'ORD:', Uuid::fromBytes($codec->encodeBinary($uuid))];
        }

        $table->addRows($encodeRows);

        if ($uuid->getVariant() === Uuid::RFC_4122) {
            $table->addRows([
                ['decode:', 'variant:',$this->getFormattedVariant($uuid)],
                ['', 'version:', $this->getFormattedVersion($uuid)],
            ]);

            $table->addRows($this->getContent($uuid));
        } else {
            $table->addRows([
                ['decode:', 'variant:', 'Not an RFC 4122 UUID'],
            ]);
        }
    }

    public function getFormattedVersion(UuidInterface $uuid): string
    {
        return self::$versionMap[$this->getVersion($uuid)];
    }

    public function getFormattedVariant(UuidInterface $uuid): string
    {
        return self::$variantMap[$uuid->getVariant() ?? -1];
    }

    /**
     * Returns content as an array of rows, each row being an array containing column values.
     *
     * @return array<string[]>
     */
    public function getContent(UuidInterface $uuid): array
    {
        $formatter = self::$formatters[$this->getVersion($uuid)] ?? null;

        if ($formatter === null) {
            throw new Exception('Unable to format UUID of unknown version');
        }

        return $formatter->getContent($uuid);
    }

    /**
     * Bypass Uuid::getVersion(), since the version of ramsey/uuid might be old
     * and not aware of versions 6, 7, and 8.
     */
    private function getVersion(UuidInterface $uuid): int
    {
        return (int) ($uuid->toString()[14] ?? -1);
    }
}
