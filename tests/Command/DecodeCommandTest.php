<?php

namespace Ramsey\Uuid\Console\Command;

use Ramsey\Uuid\Console\TestCase;
use Ramsey\Uuid\Console\Util\BufferedOutput;
use Symfony\Component\Console\Input\StringInput;

class DecodeCommandTest extends TestCase
{
    /**
     * @covers Ramsey\Uuid\Console\Command\DecodeCommand::configure
     */
    public function testConfigure()
    {
        $decode = new DecodeCommand();

        $this->assertEquals('decode', $decode->getName());
        $this->assertEquals('Decode a UUID and dump information about it', $decode->getDescription());
    }

    /**
     * @covers Ramsey\Uuid\Console\Command\DecodeCommand::execute
     */
    public function testExecuteForInvalidUuid()
    {
        if (!method_exists($this, 'expectException')) {
            $this->markTestSkipped('This version of PHPUnit does not have expectException()');
        }

        $decode = new DecodeCommand();
        $decode->setApplication(new \Ramsey\Uuid\Console\Application());

        $input = new StringInput('foobar');
        $input->bind($decode->getDefinition());

        $output = new BufferedOutput();

        $execute = new \ReflectionMethod('Ramsey\\Uuid\\Console\\Command\\DecodeCommand', 'execute');
        $execute->setAccessible(true);

        $this->expectException('Ramsey\\Uuid\\Console\\Exception');
        $this->expectExceptionMessage('Invalid UUID');

        $execute->invoke($decode, $input, $output);
    }

    /**
     * @covers Ramsey\Uuid\Console\Command\DecodeCommand::execute
     */
    public function testExecuteForNonRFC4122Uuid()
    {
        $decode = new DecodeCommand();
        $decode->setApplication(new \Ramsey\Uuid\Console\Application());

        $expected = file_get_contents('tests/console-mocks/testExecuteForNonRFC4122Uuid.txt');

        $input = new StringInput('ff6f8cb0-c57d-11e1-0b21-0800200c9a66');
        $input->bind($decode->getDefinition());

        $output = new BufferedOutput();

        $execute = new \ReflectionMethod('Ramsey\\Uuid\\Console\\Command\\DecodeCommand', 'execute');
        $execute->setAccessible(true);

        $execute->invoke($decode, $input, $output);

        $this->assertEquals($expected, $output->fetch());
    }

    /**
     * @covers Ramsey\Uuid\Console\Command\DecodeCommand::execute
     */
    public function testExecuteForVersion1Uuid()
    {
        if (class_exists('Ramsey\Uuid\Codec\OrderedTimeCodec')) {
            $expected = file_get_contents('tests/console-mocks/testExecuteForVersion1UuidWithOrd.txt');
        } else {
            $expected = file_get_contents('tests/console-mocks/testExecuteForVersion1Uuid.txt');
        }

        $decode = new DecodeCommand();
        $decode->setApplication(new \Ramsey\Uuid\Console\Application());

        $input = new StringInput('2ddbf60e-7fc4-11e3-a5ac-080027cd5e4d');
        $input->bind($decode->getDefinition());

        $output = new BufferedOutput();

        $execute = new \ReflectionMethod('Ramsey\\Uuid\\Console\\Command\\DecodeCommand', 'execute');
        $execute->setAccessible(true);

        $execute->invoke($decode, $input, $output);

        $this->assertEquals($expected, $output->fetch());
    }

    /**
     * @covers Ramsey\Uuid\Console\Command\DecodeCommand::execute
     */
    public function testExecuteForVersion2Uuid()
    {
        $expected = file_get_contents('tests/console-mocks/testExecuteForVersion2Uuid.txt');

        $decode = new DecodeCommand();
        $decode->setApplication(new \Ramsey\Uuid\Console\Application());

        $input = new StringInput('6fa459ea-ee8a-2ca4-894e-db77e160355e');
        $input->bind($decode->getDefinition());

        $output = new BufferedOutput();

        $execute = new \ReflectionMethod('Ramsey\\Uuid\\Console\\Command\\DecodeCommand', 'execute');
        $execute->setAccessible(true);

        $execute->invoke($decode, $input, $output);

        $this->assertEquals($expected, $output->fetch());
    }

    /**
     * @covers Ramsey\Uuid\Console\Command\DecodeCommand::execute
     */
    public function testExecuteForVersion3Uuid()
    {
        $expected = file_get_contents('tests/console-mocks/testExecuteForVersion3Uuid.txt');

        $decode = new DecodeCommand();
        $decode->setApplication(new \Ramsey\Uuid\Console\Application());

        $input = new StringInput('6fa459ea-ee8a-3ca4-894e-db77e160355e');
        $input->bind($decode->getDefinition());

        $output = new BufferedOutput();

        $execute = new \ReflectionMethod('Ramsey\\Uuid\\Console\\Command\\DecodeCommand', 'execute');
        $execute->setAccessible(true);

        $execute->invoke($decode, $input, $output);

        $this->assertEquals($expected, $output->fetch());
    }

    /**
     * @covers Ramsey\Uuid\Console\Command\DecodeCommand::execute
     */
    public function testExecuteForVersion4Uuid()
    {
        $expected = file_get_contents('tests/console-mocks/testExecuteForVersion4Uuid.txt');

        $decode = new DecodeCommand();
        $decode->setApplication(new \Ramsey\Uuid\Console\Application());

        $input = new StringInput('83fc61b6-b5ef-467f-9a15-89ddee668005');
        $input->bind($decode->getDefinition());

        $output = new BufferedOutput();

        $execute = new \ReflectionMethod('Ramsey\\Uuid\\Console\\Command\\DecodeCommand', 'execute');
        $execute->setAccessible(true);

        $execute->invoke($decode, $input, $output);

        $this->assertEquals($expected, $output->fetch());
    }

    /**
     * @covers Ramsey\Uuid\Console\Command\DecodeCommand::execute
     */
    public function testExecuteForVersion5Uuid()
    {
        $expected = file_get_contents('tests/console-mocks/testExecuteForVersion5Uuid.txt');

        $decode = new DecodeCommand();
        $decode->setApplication(new \Ramsey\Uuid\Console\Application());

        $input = new StringInput('886313e1-3b8a-5372-9b90-0c9aee199e5d');
        $input->bind($decode->getDefinition());

        $output = new BufferedOutput();

        $execute = new \ReflectionMethod('Ramsey\\Uuid\\Console\\Command\\DecodeCommand', 'execute');
        $execute->setAccessible(true);

        $execute->invoke($decode, $input, $output);

        $this->assertEquals($expected, $output->fetch());
    }

    public function testExecuteForOrderedTimeUuid()
    {
        if (!class_exists('Ramsey\Uuid\Codec\OrderedTimeCodec')) {
            $this->markTestSkipped('Ramsey\Uuid\Codec\OrderedTimeCodec does not exist');
        }

        $expected = file_get_contents('tests/console-mocks/testExecuteForOrderedTimeUuid.txt');

        $decode = new DecodeCommand();
        $decode->setApplication(new \Ramsey\Uuid\Console\Application());

        $input = new StringInput('11e92985-9992-1bec-a7e2-8c85901b62fa -o');
        $input->bind($decode->getDefinition());

        $output = new BufferedOutput();

        $execute = new \ReflectionMethod('Ramsey\\Uuid\\Console\\Command\\DecodeCommand', 'execute');
        $execute->setAccessible(true);

        $execute->invoke($decode, $input, $output);

        $this->assertEquals($expected, $output->fetch());
    }
}
