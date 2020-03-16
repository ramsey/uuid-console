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

use Ramsey\Uuid\Codec\OrderedTimeCodec;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
use Ramsey\Uuid\Console\Util\Formatter\V1Formatter;
use Ramsey\Uuid\Console\Util\Formatter\V2Formatter;
use Ramsey\Uuid\Console\Util\Formatter\V3Formatter;
use Ramsey\Uuid\Console\Util\Formatter\V4Formatter;
use Ramsey\Uuid\Console\Util\Formatter\V5Formatter;
use Symfony\Component\Console\Helper\Table;

class UuidFormatter
{

    private static $versionMap = [
        1 => '1 (time and node based)',
        2 => '2 (DCE security based)',
        3 => '3 (name based, MD5)',
        4 => '4 (random data based)',
        5 => '5 (name based, SHA-1)'
    ];

    private static $variantMap = [
        Uuid::RESERVED_NCS => 'Reserved',
        Uuid::RFC_4122 => 'RFC 4122',
        Uuid::RESERVED_MICROSOFT => 'Reserved for Microsoft use.',
        Uuid::RESERVED_FUTURE => 'Reserved for future use.'
    ];

    private static $formatters;

    public function __construct()
    {
        if (self::$formatters == null) {
            self::$formatters = [
                1 => new V1Formatter(),
                2 => new V2Formatter(),
                3 => new V3Formatter(),
                4 => new V4Formatter(),
                5 => new V5Formatter()
            ];
        }
    }

    public function write(Table $table, UuidInterface $uuid)
    {
        try {
            $integer = (string) $uuid->getInteger();
        } catch (UnsatisfiedDependencyException $exception) {
            $integer = 'N/A, you need Moontoast\Math\BigNumber';
        }

        $encodeRows = array(
            array('encode:', 'STR:', (string) $uuid),
            array('',        'INT:', $integer),
        );

        if ($uuid->getVersion() === 1 && class_exists('Ramsey\Uuid\Codec\OrderedTimeCodec')) {
            $factory = clone Uuid::getFactory();
            $codec = new OrderedTimeCodec($factory->getUuidBuilder());
            $encodeRows[] = array('', 'ORD:', Uuid::fromBytes($codec->encodeBinary($uuid)));
        }

        $table->addRows($encodeRows);

        if ($uuid->getVariant() == Uuid::RFC_4122) {
            $table->addRows(array(
                array('decode:', 'variant:',$this->getFormattedVariant($uuid)),
                array('',        'version:', $this->getFormattedVersion($uuid)),
            ));

            $table->addRows($this->getContent($uuid));
        } else {
            $table->addRows(array(
                array('decode:', 'variant:', 'Not an RFC 4122 UUID'),
            ));
        }
    }

    public function getFormattedVersion(UuidInterface $uuid)
    {
        return self::$versionMap[$uuid->getVersion()];
    }

    public function getFormattedVariant(UuidInterface $uuid)
    {
        return self::$variantMap[$uuid->getVariant()];
    }

    /**
     * Returns content as an array of rows, each row being an array containing column values.
     */
    public function getContent(UuidInterface $uuid)
    {
        $formatter = self::$formatters[$uuid->getVersion()];

        return $formatter->getContent($uuid);
    }
}
