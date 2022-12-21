<?php

declare(strict_types=1);

namespace Ramsey\Uuid\Console\Command;

use Ramsey\Uuid\Console\Application;
use Ramsey\Uuid\Console\Exception;
use Ramsey\Uuid\Console\TestCase;
use Ramsey\Uuid\Console\Util\BufferedOutput;
use ReflectionMethod;
use Symfony\Component\Console\Input\StringInput;

use function class_exists;
use function file_get_contents;
use function method_exists;

class DecodeCommandTest extends TestCase
{
    public function testConfigure(): void
    {
        $decode = new DecodeCommand();

        $this->assertEquals('decode', $decode->getName());
        $this->assertEquals('Decode a UUID and dump information about it', $decode->getDescription());
    }

    public function testExecuteForInvalidUuid(): void
    {
        if (!method_exists($this, 'expectException')) {
            $this->markTestSkipped('This version of PHPUnit does not have expectException()');
        }

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

        $expected = file_get_contents('tests/console-mocks/testExecuteForNonRFC4122Uuid.txt');

        $input = new StringInput('ff6f8cb0-c57d-11e1-0b21-0800200c9a66');
        $input->bind($decode->getDefinition());

        $output = new BufferedOutput();

        $execute = new ReflectionMethod(DecodeCommand::class, 'execute');
        $execute->setAccessible(true);

        $execute->invoke($decode, $input, $output);

        $this->assertEquals($expected, $output->fetch());
    }

    public function testExecuteForVersion1Uuid(): void
    {
        if (class_exists('Ramsey\Uuid\Codec\OrderedTimeCodec')) {
            $expected = file_get_contents('tests/console-mocks/testExecuteForVersion1UuidWithOrd.txt');
        } else {
            $expected = file_get_contents('tests/console-mocks/testExecuteForVersion1Uuid.txt');
        }

        $decode = new DecodeCommand();
        $decode->setApplication(new Application());

        $input = new StringInput('2ddbf60e-7fc4-11e3-a5ac-080027cd5e4d');
        $input->bind($decode->getDefinition());

        $output = new BufferedOutput();

        $execute = new ReflectionMethod(DecodeCommand::class, 'execute');
        $execute->setAccessible(true);

        $execute->invoke($decode, $input, $output);

        $this->assertEquals($expected, $output->fetch());
    }

    public function testExecuteForVersion2Uuid(): void
    {
        $expected = file_get_contents('tests/console-mocks/testExecuteForVersion2Uuid.txt');

        $decode = new DecodeCommand();
        $decode->setApplication(new Application());

        $input = new StringInput('6fa459ea-ee8a-2ca4-894e-db77e160355e');
        $input->bind($decode->getDefinition());

        $output = new BufferedOutput();

        $execute = new ReflectionMethod(DecodeCommand::class, 'execute');
        $execute->setAccessible(true);

        $execute->invoke($decode, $input, $output);

        $this->assertEquals($expected, $output->fetch());
    }

    public function testExecuteForVersion3Uuid(): void
    {
        $expected = file_get_contents('tests/console-mocks/testExecuteForVersion3Uuid.txt');

        $decode = new DecodeCommand();
        $decode->setApplication(new Application());

        $input = new StringInput('6fa459ea-ee8a-3ca4-894e-db77e160355e');
        $input->bind($decode->getDefinition());

        $output = new BufferedOutput();

        $execute = new ReflectionMethod(DecodeCommand::class, 'execute');
        $execute->setAccessible(true);

        $execute->invoke($decode, $input, $output);

        $this->assertEquals($expected, $output->fetch());
    }

    public function testExecuteForVersion4Uuid(): void
    {
        $expected = file_get_contents('tests/console-mocks/testExecuteForVersion4Uuid.txt');

        $decode = new DecodeCommand();
        $decode->setApplication(new Application());

        $input = new StringInput('83fc61b6-b5ef-467f-9a15-89ddee668005');
        $input->bind($decode->getDefinition());

        $output = new BufferedOutput();

        $execute = new ReflectionMethod(DecodeCommand::class, 'execute');
        $execute->setAccessible(true);

        $execute->invoke($decode, $input, $output);

        $this->assertEquals($expected, $output->fetch());
    }

    public function testExecuteForVersion5Uuid(): void
    {
        $expected = file_get_contents('tests/console-mocks/testExecuteForVersion5Uuid.txt');

        $decode = new DecodeCommand();
        $decode->setApplication(new Application());

        $input = new StringInput('886313e1-3b8a-5372-9b90-0c9aee199e5d');
        $input->bind($decode->getDefinition());

        $output = new BufferedOutput();

        $execute = new ReflectionMethod(DecodeCommand::class, 'execute');
        $execute->setAccessible(true);

        $execute->invoke($decode, $input, $output);

        $this->assertEquals($expected, $output->fetch());
    }

    public function testExecuteForOrderedTimeUuid(): void
    {
        if (!class_exists('Ramsey\Uuid\Codec\OrderedTimeCodec')) {
            $this->markTestSkipped('Ramsey\Uuid\Codec\OrderedTimeCodec does not exist');
        }

        $expected = file_get_contents('tests/console-mocks/testExecuteForOrderedTimeUuid.txt');

        $decode = new DecodeCommand();
        $decode->setApplication(new Application());

        $input = new StringInput('11e92985-9992-1bec-a7e2-8c85901b62fa -o');
        $input->bind($decode->getDefinition());

        $output = new BufferedOutput();

        $execute = new ReflectionMethod(DecodeCommand::class, 'execute');
        $execute->setAccessible(true);

        $execute->invoke($decode, $input, $output);

        $this->assertEquals($expected, $output->fetch());
    }
}
