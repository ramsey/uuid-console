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

namespace Ramsey\Uuid\Console\Command;

use Ramsey\Uuid\Codec\OrderedTimeCodec;
use Ramsey\Uuid\Console\Exception;
use Ramsey\Uuid\Console\Util\UuidFormatter;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidFactory;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

use function assert;

/**
 * Provides the console command to decode UUIDs and dump information about them
 */
class DecodeCommand extends Command
{
    protected function configure(): void
    {
        parent::configure();

        $this
            ->setName('decode')
            ->setDescription('Decode a UUID and dump information about it')
            ->addArgument(
                'uuid',
                InputArgument::REQUIRED,
                'The UUID to decode.',
            )
            ->addOption(
                'ordered-time',
                'o',
                InputOption::VALUE_NONE,
                'Puts back parts into order.',
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        /** @var scalar $inputUuid */
        $inputUuid = $input->getArgument('uuid');

        if (!Uuid::isValid((string) $inputUuid)) {
            throw new Exception('Invalid UUID (' . $inputUuid . ')');
        }

        $uuid = Uuid::fromString((string) $inputUuid);

        if ($input->getOption('ordered-time')) {
            $factory = clone Uuid::getFactory();
            assert($factory instanceof UuidFactory);

            $codec = new OrderedTimeCodec($factory->getUuidBuilder());
            $uuid = $codec->decodeBytes($uuid->getBytes());
        }

        $table = $this->createTable($output);
        $table->setStyle('borderless');

        (new UuidFormatter())->write($table, $uuid);

        $table->render();

        return 0;
    }

    protected function createTable(OutputInterface $output): Table
    {
        return new Table($output);
    }
}
