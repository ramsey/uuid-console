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

use Ramsey\Uuid\Console\Exception;
use Ramsey\Uuid\FeatureSet;
use Ramsey\Uuid\Generator\CombGenerator;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidFactory;
use Ramsey\Uuid\UuidInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

use function assert;
use function filter_var;

use const FILTER_VALIDATE_INT;

/**
 * Provides the console command to generate UUIDs
 */
class GenerateCommand extends Command
{
    protected function configure(): void
    {
        parent::configure();

        $this->setName('generate')
            ->setDescription('Generate a UUID')
            ->addArgument(
                'version',
                InputArgument::OPTIONAL,
                'The UUID version to generate. Supported are version "1", "3", '
                . '"4" and "5".',
                1,
            )
            ->addArgument(
                'namespace',
                InputArgument::OPTIONAL,
                'For version 3 or 5 UUIDs, the namespace to create a UUID for. '
                . 'May be either a UUID in string representation or an identifier '
                . 'for internally pre-defined namespace UUIDs (currently known '
                . 'are "ns:DNS", "ns:URL", "ns:OID", and "ns:X500").',
            )
            ->addArgument(
                'name',
                InputArgument::OPTIONAL,
                'For version 3 or 5 UUIDs, the name to create a UUID for. '
                . 'The name is a string of arbitrary length.',
            )
            ->addOption(
                'count',
                'c',
                InputOption::VALUE_REQUIRED,
                'Generate count UUIDs instead of just a single one.',
                1,
            )
            ->addOption(
                'comb',
                null,
                InputOption::VALUE_NONE,
                'For version 4 UUIDs, uses the COMB strategy to generate the random data.',
            )
            ->addOption(
                'guid',
                'g',
                InputOption::VALUE_NONE,
                'Returns a GUID formatted UUID.',
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $uuids = [];

        $count = filter_var(
            $input->getOption('count'),
            FILTER_VALIDATE_INT,
            [
                'default' => 1,
                'min_range' => 1,
            ],
        );

        if ((bool) $input->getOption('guid') === true) {
            $features = new FeatureSet(true);

            Uuid::setFactory(new UuidFactory($features));
        }

        if ((bool) $input->getOption('comb') === true) {
            $factory = Uuid::getFactory();
            assert($factory instanceof UuidFactory);

            $factory->setRandomGenerator(
                new CombGenerator($factory->getRandomGenerator(), $factory->getNumberConverter()),
            );
        }

        /** @var scalar $inputVersion */
        $inputVersion = $input->getArgument('version');

        /** @var scalar $inputNamespace */
        $inputNamespace = $input->getArgument('namespace');

        /** @var scalar $inputName */
        $inputName = $input->getArgument('name');

        for ($i = 0; $i < $count; $i++) {
            $uuids[] = $this->createUuid((int) $inputVersion, (string) $inputNamespace, (string) $inputName);
        }

        foreach ($uuids as $uuid) {
            $output->writeln((string) $uuid);
        }

        return 0;
    }

    /**
     * Creates the requested UUID
     *
     * @throws Exception
     */
    protected function createUuid(int $version, ?string $namespace = null, ?string $name = null): UuidInterface
    {
        switch ($version) {
            case 1:
                return Uuid::uuid1();
            case 4:
                return Uuid::uuid4();
            case 3:
            case 5:
                $ns = $this->validateNamespace((string) $namespace);
                if ($version === 3) {
                    return Uuid::uuid3($ns, (string) $name);
                } else {
                    return Uuid::uuid5($ns, (string) $name);
                }
            default:
                throw new Exception('Invalid UUID version. Supported are version "1", "3", "4", and "5".');
        }
    }

    /**
     * Validates the namespace argument
     *
     * @throws Exception
     */
    protected function validateNamespace(string $namespace): string
    {
        switch ($namespace) {
            case 'ns:DNS':
                return Uuid::NAMESPACE_DNS;
            case 'ns:URL':
                return Uuid::NAMESPACE_URL;
            case 'ns:OID':
                return Uuid::NAMESPACE_OID;
            case 'ns:X500':
                return Uuid::NAMESPACE_X500;
        }

        if (Uuid::isValid($namespace)) {
            return $namespace;
        }

        throw new Exception(
            'Invalid namespace. '
            . 'May be either a UUID in string representation or an identifier '
            . 'for internally pre-defined namespace UUIDs (currently known '
            . 'are "ns:DNS", "ns:URL", "ns:OID", and "ns:X500").',
        );
    }
}
