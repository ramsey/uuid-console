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
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

use function class_exists;

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
        if (!Uuid::isValid($input->getArgument('uuid'))) {
            throw new Exception('Invalid UUID (' . $input->getArgument('uuid') . ')');
        }

        $uuid = Uuid::fromString($input->getArgument('uuid'));

        if ($input->getOption('ordered-time')) {
            if (!class_exists('Ramsey\Uuid\Codec\OrderedTimeCodec')) {
                throw new Exception('To use ordered-time option requires ramsey/uuid=^3.5');
            }

            $factory = clone Uuid::getFactory();
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
