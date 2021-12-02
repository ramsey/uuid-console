<?php

declare(strict_types=1);

namespace Ramsey\Uuid\Console\Command;

use Ramsey\Uuid\Console\Application;
use Ramsey\Uuid\Console\Exception;
use Ramsey\Uuid\Console\TestCase;
use Ramsey\Uuid\Console\Util\BufferedOutput;
use ReflectionMethod;
use Spatie\Snapshots\MatchesSnapshots;
use Symfony\Component\Console\Input\StringInput;

class DecodeCommandTest extends TestCase
{
    use MatchesSnapshots;

    public function testConfigure(): void
    {
        $decode = new DecodeCommand();

        $this->assertSame('decode', $decode->getName());
        $this->assertSame('Decode a UUID and dump information about it', $decode->getDescription());
    }

    public function testExecuteForInvalidUuid(): void
    {
        $decode = new DecodeCommand();
        $decode->setApplication(new Application());

        $input = new StringInput('foobar');
        $input->bind($decode->getDefinition());

        $output = new BufferedOutput();

        $execute = new ReflectionMethod(DecodeCommand::class, 'execute');
        $execute->setAccessible(true);

        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Invalid UUID');

        $execute->invoke($decode, $input, $output);
    }

    public function testExecuteForNonRFC4122Uuid(): void
    {
        $decode = new DecodeCommand();
        $decode->setApplication(new Application());

        $input = new StringInput('ff6f8cb0-c57d-11e1-0b21-0800200c9a66');
        $input->bind($decode->getDefinition());

        $output = new BufferedOutput();

        $execute = new ReflectionMethod(DecodeCommand::class, 'execute');
        $execute->setAccessible(true);

        $execute->invoke($decode, $input, $output);

        $consoleOutput = $output->fetch();

        $this->assertMatchesTextSnapshot($consoleOutput);
    }

    public function testExecuteForVersion1Uuid(): void
    {
        $decode = new DecodeCommand();
        $decode->setApplication(new Application());

        $input = new StringInput('2ddbf60e-7fc4-11e3-a5ac-080027cd5e4d');
        $input->bind($decode->getDefinition());

        $output = new BufferedOutput();

        $execute = new ReflectionMethod(DecodeCommand::class, 'execute');
        $execute->setAccessible(true);

        $execute->invoke($decode, $input, $output);

        $consoleOutput = $output->fetch();

        $this->assertMatchesTextSnapshot($consoleOutput);
    }

    public function testExecuteForVersion2Uuid(): void
    {
        $decode = new DecodeCommand();
        $decode->setApplication(new Application());

        $input = new StringInput('6fa459ea-ee8a-2ca4-894e-db77e160355e');
        $input->bind($decode->getDefinition());

        $output = new BufferedOutput();

        $execute = new ReflectionMethod(DecodeCommand::class, 'execute');
        $execute->setAccessible(true);

        $execute->invoke($decode, $input, $output);

        $consoleOutput = $output->fetch();

        $this->assertMatchesTextSnapshot($consoleOutput);
    }

    public function testExecuteForVersion3Uuid(): void
    {
        $decode = new DecodeCommand();
        $decode->setApplication(new Application());

        $input = new StringInput('6fa459ea-ee8a-3ca4-894e-db77e160355e');
        $input->bind($decode->getDefinition());

        $output = new BufferedOutput();

        $execute = new ReflectionMethod(DecodeCommand::class, 'execute');
        $execute->setAccessible(true);

        $execute->invoke($decode, $input, $output);

        $consoleOutput = $output->fetch();

        $this->assertMatchesTextSnapshot($consoleOutput);
    }

    public function testExecuteForVersion4Uuid(): void
    {
        $decode = new DecodeCommand();
        $decode->setApplication(new Application());

        $input = new StringInput('83fc61b6-b5ef-467f-9a15-89ddee668005');
        $input->bind($decode->getDefinition());

        $output = new BufferedOutput();

        $execute = new ReflectionMethod(DecodeCommand::class, 'execute');
        $execute->setAccessible(true);

        $execute->invoke($decode, $input, $output);

        $consoleOutput = $output->fetch();

        $this->assertMatchesTextSnapshot($consoleOutput);
    }

    public function testExecuteForVersion5Uuid(): void
    {
        $decode = new DecodeCommand();
        $decode->setApplication(new Application());

        $input = new StringInput('886313e1-3b8a-5372-9b90-0c9aee199e5d');
        $input->bind($decode->getDefinition());

        $output = new BufferedOutput();

        $execute = new ReflectionMethod(DecodeCommand::class, 'execute');
        $execute->setAccessible(true);

        $execute->invoke($decode, $input, $output);

        $consoleOutput = $output->fetch();

        $this->assertMatchesTextSnapshot($consoleOutput);
    }

    public function testExecuteForOrderedTimeUuid(): void
    {
        $decode = new DecodeCommand();
        $decode->setApplication(new Application());

        $input = new StringInput('11e92985-9992-1bec-a7e2-8c85901b62fa -o');
        $input->bind($decode->getDefinition());

        $output = new BufferedOutput();

        $execute = new ReflectionMethod(DecodeCommand::class, 'execute');
        $execute->setAccessible(true);

        $execute->invoke($decode, $input, $output);

        $consoleOutput = $output->fetch();

        $this->assertMatchesTextSnapshot($consoleOutput);
    }
}
