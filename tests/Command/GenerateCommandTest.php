<?php

namespace Ramsey\Uuid\Console\Command;

use Ramsey\Uuid\Console\TestCase;
use Ramsey\Uuid\Console\Util\TestOutput;
use Ramsey\Uuid\Uuid;
use Symfony\Component\Console\Input\StringInput;

class GenerateCommandTest extends TestCase
{
    const FOO_NS = 'bbd8a651-6f00-11e3-8ad8-28cfe91e4895';

    /**
     * @covers Ramsey\Uuid\Console\Command\GenerateCommand::configure
     */
    public function testConfigure()
    {
        $generate = new GenerateCommand();

        $this->assertEquals('generate', $generate->getName());
        $this->assertEquals('Generate a UUID', $generate->getDescription());
    }

    /**
     * @covers Ramsey\Uuid\Console\Command\GenerateCommand::execute
     * @covers Ramsey\Uuid\Console\Command\GenerateCommand::createUuid
     */
    public function testExecuteForUuidDefault()
    {
        $generate = new GenerateCommand();

        $input = new StringInput('');
        $input->bind($generate->getDefinition());

        $output = new TestOutput();

        $execute = new \ReflectionMethod('Ramsey\\Uuid\\Console\\Command\\GenerateCommand', 'execute');
        $execute->setAccessible(true);

        $execute->invoke($generate, $input, $output);

        $this->assertCount(1, $output->messages);
        $this->assertTrue(Uuid::isValid($output->messages[0]));
        $this->assertEquals(1, Uuid::fromString($output->messages[0])->getVersion());
    }

    /**
     * @covers Ramsey\Uuid\Console\Command\GenerateCommand::execute
     * @covers Ramsey\Uuid\Console\Command\GenerateCommand::createUuid
     */
    public function testExecuteForUuidDefaultWithCount()
    {
        $generate = new GenerateCommand();

        //
        // Test using the "-c" option
        //

        $input1 = new StringInput('-c 9');
        $input1->bind($generate->getDefinition());

        $output1 = new TestOutput();

        $execute = new \ReflectionMethod('Ramsey\\Uuid\\Console\\Command\\GenerateCommand', 'execute');
        $execute->setAccessible(true);

        $execute->invoke($generate, $input1, $output1);

        $this->assertCount(9, $output1->messages);

        foreach ($output1->messages as $uuid) {
            $this->assertTrue(Uuid::isValid($uuid));
            $this->assertEquals(1, Uuid::fromString($uuid)->getVersion());
        }

        //
        // Test using the "--count" option
        //

        $input2 = new StringInput('--count=12');
        $input2->bind($generate->getDefinition());

        $output2 = new TestOutput();

        $execute = new \ReflectionMethod('Ramsey\\Uuid\\Console\\Command\\GenerateCommand', 'execute');
        $execute->setAccessible(true);

        $execute->invoke($generate, $input2, $output2);

        $this->assertCount(12, $output2->messages);

        foreach ($output2->messages as $uuid) {
            $this->assertTrue(Uuid::isValid($uuid));
            $this->assertEquals(1, Uuid::fromString($uuid)->getVersion());
        }
    }

    /**
     * @covers Ramsey\Uuid\Console\Command\GenerateCommand::execute
     * @covers Ramsey\Uuid\Console\Command\GenerateCommand::createUuid
     */
    public function testExecuteForUuidSpecifyVersion1()
    {
        $generate = new GenerateCommand();

        $input = new StringInput('1');
        $input->bind($generate->getDefinition());

        $output = new TestOutput();

        $execute = new \ReflectionMethod('Ramsey\\Uuid\\Console\\Command\\GenerateCommand', 'execute');
        $execute->setAccessible(true);

        $execute->invoke($generate, $input, $output);

        $this->assertCount(1, $output->messages);
        $this->assertTrue(Uuid::isValid($output->messages[0]));
        $this->assertEquals(1, Uuid::fromString($output->messages[0])->getVersion());
    }

    /**
     * @covers Ramsey\Uuid\Console\Command\GenerateCommand::execute
     * @covers Ramsey\Uuid\Console\Command\GenerateCommand::createUuid
     */
    public function testExecuteForUuidSpecifyVersion1WithCount()
    {
        $generate = new GenerateCommand();

        //
        // Test using the "-c" option
        //

        $input1 = new StringInput('1 -c 3');
        $input1->bind($generate->getDefinition());

        $output1 = new TestOutput();

        $execute = new \ReflectionMethod('Ramsey\\Uuid\\Console\\Command\\GenerateCommand', 'execute');
        $execute->setAccessible(true);

        $execute->invoke($generate, $input1, $output1);

        $this->assertCount(3, $output1->messages);

        foreach ($output1->messages as $uuid) {
            $this->assertTrue(Uuid::isValid($uuid));
            $this->assertEquals(1, Uuid::fromString($uuid)->getVersion());
        }

        //
        // Test using the "--count" option
        //

        $input2 = new StringInput('1 --count=8');
        $input2->bind($generate->getDefinition());

        $output2 = new TestOutput();

        $execute = new \ReflectionMethod('Ramsey\\Uuid\\Console\\Command\\GenerateCommand', 'execute');
        $execute->setAccessible(true);

        $execute->invoke($generate, $input2, $output2);

        $this->assertCount(8, $output2->messages);

        foreach ($output2->messages as $uuid) {
            $this->assertTrue(Uuid::isValid($uuid));
            $this->assertEquals(1, Uuid::fromString($uuid)->getVersion());
        }
    }

    /**
     * @covers Ramsey\Uuid\Console\Command\GenerateCommand::execute
     * @covers Ramsey\Uuid\Console\Command\GenerateCommand::createUuid
     */
    public function testExecuteForUuidSpecifyVersion4()
    {
        $generate = new GenerateCommand();

        $input = new StringInput('4');
        $input->bind($generate->getDefinition());

        $output = new TestOutput();

        $execute = new \ReflectionMethod('Ramsey\\Uuid\\Console\\Command\\GenerateCommand', 'execute');
        $execute->setAccessible(true);

        $execute->invoke($generate, $input, $output);

        $this->assertCount(1, $output->messages);
        $this->assertTrue(Uuid::isValid($output->messages[0]));
        $this->assertEquals(4, Uuid::fromString($output->messages[0])->getVersion());
    }

    /**
     * @covers Ramsey\Uuid\Console\Command\GenerateCommand::execute
     * @covers Ramsey\Uuid\Console\Command\GenerateCommand::createUuid
     */
    public function testExecuteForUuidSpecifyVersion4WithCount()
    {
        $generate = new GenerateCommand();

        //
        // Test using the "-c" option
        //

        $input1 = new StringInput('4 -c 3');
        $input1->bind($generate->getDefinition());

        $output1 = new TestOutput();

        $execute = new \ReflectionMethod('Ramsey\\Uuid\\Console\\Command\\GenerateCommand', 'execute');
        $execute->setAccessible(true);

        $execute->invoke($generate, $input1, $output1);

        $this->assertCount(3, $output1->messages);

        foreach ($output1->messages as $uuid) {
            $this->assertTrue(Uuid::isValid($uuid));
            $this->assertEquals(4, Uuid::fromString($uuid)->getVersion());
        }

        //
        // Test using the "--count" option
        //

        $input2 = new StringInput('4 --count=8');
        $input2->bind($generate->getDefinition());

        $output2 = new TestOutput();

        $execute = new \ReflectionMethod('Ramsey\\Uuid\\Console\\Command\\GenerateCommand', 'execute');
        $execute->setAccessible(true);

        $execute->invoke($generate, $input2, $output2);

        $this->assertCount(8, $output2->messages);

        foreach ($output2->messages as $uuid) {
            $this->assertTrue(Uuid::isValid($uuid));
            $this->assertEquals(4, Uuid::fromString($uuid)->getVersion());
        }
    }

    /**
     * @covers Ramsey\Uuid\Console\Command\GenerateCommand::execute
     * @covers Ramsey\Uuid\Console\Command\GenerateCommand::createUuid
     */
    public function testExecuteForUuidSpecifyVersion6()
    {
        if (!method_exists('\Ramsey\Uuid\Uuid', 'uuid6')) {
            $this->markTestSkipped('Not supported version of ramsey/uuid');
        }

        $generate = new GenerateCommand();

        $input = new StringInput('6');
        $input->bind($generate->getDefinition());

        $output = new TestOutput();

        $execute = new \ReflectionMethod('Ramsey\\Uuid\\Console\\Command\\GenerateCommand', 'execute');
        $execute->setAccessible(true);

        $execute->invoke($generate, $input, $output);

        $this->assertCount(1, $output->messages);
        $this->assertTrue(Uuid::isValid($output->messages[0]));
        $this->assertEquals(6, Uuid::fromString($output->messages[0])->getVersion());
    }

    /**
     * @covers Ramsey\Uuid\Console\Command\GenerateCommand::execute
     * @covers Ramsey\Uuid\Console\Command\GenerateCommand::createUuid
     */
    public function testExecuteForUuidSpecifyVersion6WithCount()
    {
        if (!method_exists('\Ramsey\Uuid\Uuid', 'uuid6')) {
            $this->markTestSkipped('Not supported version of ramsey/uuid');
        }
        $generate = new GenerateCommand();

        //
        // Test using the "-c" option
        //

        $input1 = new StringInput('6 -c 3');
        $input1->bind($generate->getDefinition());

        $output1 = new TestOutput();

        $execute = new \ReflectionMethod('Ramsey\\Uuid\\Console\\Command\\GenerateCommand', 'execute');
        $execute->setAccessible(true);

        $execute->invoke($generate, $input1, $output1);

        $this->assertCount(3, $output1->messages);

        foreach ($output1->messages as $uuid) {
            $this->assertTrue(Uuid::isValid($uuid));
            $this->assertEquals(6, Uuid::fromString($uuid)->getVersion());
        }

        //
        // Test using the "--count" option
        //

        $input2 = new StringInput('6 --count=8');
        $input2->bind($generate->getDefinition());

        $output2 = new TestOutput();

        $execute = new \ReflectionMethod('Ramsey\\Uuid\\Console\\Command\\GenerateCommand', 'execute');
        $execute->setAccessible(true);

        $execute->invoke($generate, $input2, $output2);

        $this->assertCount(8, $output2->messages);

        foreach ($output2->messages as $uuid) {
            $this->assertTrue(Uuid::isValid($uuid));
            $this->assertEquals(6, Uuid::fromString($uuid)->getVersion());
        }
    }


    /**
     * @covers Ramsey\Uuid\Console\Command\GenerateCommand::execute
     * @covers Ramsey\Uuid\Console\Command\GenerateCommand::createUuid
     */
    public function testExecuteForUuidSpecifyVersion6OnUnsupportedVersion()
    {
        if (!method_exists($this, 'expectException')) {
            $this->markTestSkipped('This version of PHPUnit does not have expectException()');
        }
        if (method_exists('\Ramsey\Uuid\Uuid', 'uuid6')) {
            $this->markTestSkipped('Not supported version of ramsey/uuid');
        }
        $generate = new GenerateCommand();

        //
        // Test using the "-c" option
        //

        $input1 = new StringInput('6');
        $input1->bind($generate->getDefinition());

        $output1 = new TestOutput();

        $execute = new \ReflectionMethod('Ramsey\\Uuid\\Console\\Command\\GenerateCommand', 'execute');
        $execute->setAccessible(true);

        $this->expectException('Ramsey\\Uuid\\Console\\Exception');
        $this->expectExceptionMessage('Your version of ramsey/uuid don\'t support uuid6.');

        $execute->invoke($generate, $input1, $output1);
    }

    /**
     * @covers Ramsey\Uuid\Console\Command\GenerateCommand::execute
     * @covers Ramsey\Uuid\Console\Command\GenerateCommand::createUuid
     * @covers Ramsey\Uuid\Console\Command\GenerateCommand::validateNamespace
     */
    public function testExecuteForUuidSpecifyVersion3WithDnsNs()
    {
        $generate = new GenerateCommand();

        $input = new StringInput('3 ns:DNS "python.org"');
        $input->bind($generate->getDefinition());

        $output = new TestOutput();

        $execute = new \ReflectionMethod('Ramsey\\Uuid\\Console\\Command\\GenerateCommand', 'execute');
        $execute->setAccessible(true);

        $execute->invoke($generate, $input, $output);

        $this->assertCount(1, $output->messages);
        $this->assertTrue(Uuid::isValid($output->messages[0]));
        $this->assertEquals(3, Uuid::fromString($output->messages[0])->getVersion());
        $this->assertEquals('6fa459ea-ee8a-3ca4-894e-db77e160355e', $output->messages[0]);
    }

    /**
     * @covers Ramsey\Uuid\Console\Command\GenerateCommand::execute
     * @covers Ramsey\Uuid\Console\Command\GenerateCommand::createUuid
     * @covers Ramsey\Uuid\Console\Command\GenerateCommand::validateNamespace
     */
    public function testExecuteForUuidSpecifyVersion3WithUrlNs()
    {
        $generate = new GenerateCommand();

        $input = new StringInput('3 ns:URL "http://python.org/"');
        $input->bind($generate->getDefinition());

        $output = new TestOutput();

        $execute = new \ReflectionMethod('Ramsey\\Uuid\\Console\\Command\\GenerateCommand', 'execute');
        $execute->setAccessible(true);

        $execute->invoke($generate, $input, $output);

        $this->assertCount(1, $output->messages);
        $this->assertTrue(Uuid::isValid($output->messages[0]));
        $this->assertEquals(3, Uuid::fromString($output->messages[0])->getVersion());
        $this->assertEquals('9fe8e8c4-aaa8-32a9-a55c-4535a88b748d', $output->messages[0]);
    }

    /**
     * @covers Ramsey\Uuid\Console\Command\GenerateCommand::execute
     * @covers Ramsey\Uuid\Console\Command\GenerateCommand::createUuid
     * @covers Ramsey\Uuid\Console\Command\GenerateCommand::validateNamespace
     */
    public function testExecuteForUuidSpecifyVersion3WithOidNs()
    {
        $generate = new GenerateCommand();

        $input = new StringInput('3 ns:OID "1.3.6.1"');
        $input->bind($generate->getDefinition());

        $output = new TestOutput();

        $execute = new \ReflectionMethod('Ramsey\\Uuid\\Console\\Command\\GenerateCommand', 'execute');
        $execute->setAccessible(true);

        $execute->invoke($generate, $input, $output);

        $this->assertCount(1, $output->messages);
        $this->assertTrue(Uuid::isValid($output->messages[0]));
        $this->assertEquals(3, Uuid::fromString($output->messages[0])->getVersion());
        $this->assertEquals('dd1a1cef-13d5-368a-ad82-eca71acd4cd1', $output->messages[0]);
    }

    /**
     * @covers Ramsey\Uuid\Console\Command\GenerateCommand::execute
     * @covers Ramsey\Uuid\Console\Command\GenerateCommand::createUuid
     * @covers Ramsey\Uuid\Console\Command\GenerateCommand::validateNamespace
     */
    public function testExecuteForUuidSpecifyVersion3WithX500Ns()
    {
        $generate = new GenerateCommand();

        $input = new StringInput('3 ns:X500 "c=ca"');
        $input->bind($generate->getDefinition());

        $output = new TestOutput();

        $execute = new \ReflectionMethod('Ramsey\\Uuid\\Console\\Command\\GenerateCommand', 'execute');
        $execute->setAccessible(true);

        $execute->invoke($generate, $input, $output);

        $this->assertCount(1, $output->messages);
        $this->assertTrue(Uuid::isValid($output->messages[0]));
        $this->assertEquals(3, Uuid::fromString($output->messages[0])->getVersion());
        $this->assertEquals('658d3002-db6b-3040-a1d1-8ddd7d189a4d', $output->messages[0]);
    }

    /**
     * @covers Ramsey\Uuid\Console\Command\GenerateCommand::execute
     * @covers Ramsey\Uuid\Console\Command\GenerateCommand::createUuid
     * @covers Ramsey\Uuid\Console\Command\GenerateCommand::validateNamespace
     */
    public function testExecuteForUuidSpecifyVersion3WithOtherNs()
    {
        $generate = new GenerateCommand();

        $input = new StringInput('3 bbd8a651-6f00-11e3-8ad8-28cfe91e4895 foobar');
        $input->bind($generate->getDefinition());

        $output = new TestOutput();

        $execute = new \ReflectionMethod('Ramsey\\Uuid\\Console\\Command\\GenerateCommand', 'execute');
        $execute->setAccessible(true);

        $execute->invoke($generate, $input, $output);

        $this->assertCount(1, $output->messages);
        $this->assertTrue(Uuid::isValid($output->messages[0]));
        $this->assertEquals(3, Uuid::fromString($output->messages[0])->getVersion());
        $this->assertEquals('0707b2c0-1f0f-3b2b-9a90-371396a90a86', $output->messages[0]);
    }

    /**
     * @covers Ramsey\Uuid\Console\Command\GenerateCommand::execute
     * @covers Ramsey\Uuid\Console\Command\GenerateCommand::createUuid
     * @covers Ramsey\Uuid\Console\Command\GenerateCommand::validateNamespace
     */
    public function testExecuteForUuidSpecifyVersion3WithInvalidNs()
    {
        if (!method_exists($this, 'expectException')) {
            $this->markTestSkipped('This version of PHPUnit does not have expectException()');
        }

        $generate = new GenerateCommand();

        $input = new StringInput('3 foo foobar');
        $input->bind($generate->getDefinition());

        $output = new TestOutput();

        $execute = new \ReflectionMethod('Ramsey\\Uuid\\Console\\Command\\GenerateCommand', 'execute');
        $execute->setAccessible(true);

        $this->expectException('Ramsey\\Uuid\\Console\\Exception');
        $this->expectExceptionMessage('May be either a UUID in string representation or an identifier');

        $execute->invoke($generate, $input, $output);
    }

    /**
     * @covers Ramsey\Uuid\Console\Command\GenerateCommand::execute
     * @covers Ramsey\Uuid\Console\Command\GenerateCommand::createUuid
     * @covers Ramsey\Uuid\Console\Command\GenerateCommand::validateNamespace
     */
    public function testExecuteForUuidSpecifyVersion3WithCount()
    {
        $generate = new GenerateCommand();

        $input = new StringInput('3 ns:DNS "python.org" -c 21');
        $input->bind($generate->getDefinition());

        $output = new TestOutput();

        $execute = new \ReflectionMethod('Ramsey\\Uuid\\Console\\Command\\GenerateCommand', 'execute');
        $execute->setAccessible(true);

        $execute->invoke($generate, $input, $output);

        $this->assertCount(21, $output->messages);

        foreach ($output->messages as $uuid) {
            $this->assertTrue(Uuid::isValid($uuid));
            $this->assertEquals(3, Uuid::fromString($uuid)->getVersion());
            $this->assertEquals('6fa459ea-ee8a-3ca4-894e-db77e160355e', $uuid);
        }
    }

    /**
     * @covers Ramsey\Uuid\Console\Command\GenerateCommand::execute
     * @covers Ramsey\Uuid\Console\Command\GenerateCommand::createUuid
     * @covers Ramsey\Uuid\Console\Command\GenerateCommand::validateNamespace
     */
    public function testExecuteForUuidSpecifyVersion3WithoutName()
    {
        $generate = new GenerateCommand();

        $input = new StringInput('3 ns:DNS');
        $input->bind($generate->getDefinition());

        $output = new TestOutput();

        $execute = new \ReflectionMethod('Ramsey\\Uuid\\Console\\Command\\GenerateCommand', 'execute');
        $execute->setAccessible(true);

        $execute->invoke($generate, $input, $output);

        $this->assertCount(1, $output->messages);

        foreach ($output->messages as $uuid) {
            $this->assertTrue(Uuid::isValid($uuid));
            $this->assertEquals(3, Uuid::fromString($uuid)->getVersion());
            $this->assertEquals('c87ee674-4ddc-3efe-a74e-dfe25da5d7b3', $uuid);
        }
    }

    /**
     * @covers Ramsey\Uuid\Console\Command\GenerateCommand::execute
     * @covers Ramsey\Uuid\Console\Command\GenerateCommand::createUuid
     * @covers Ramsey\Uuid\Console\Command\GenerateCommand::validateNamespace
     */
    public function testExecuteForUuidSpecifyVersion5WithDnsNs()
    {
        $generate = new GenerateCommand();

        $input = new StringInput('5 ns:DNS "python.org"');
        $input->bind($generate->getDefinition());

        $output = new TestOutput();

        $execute = new \ReflectionMethod('Ramsey\\Uuid\\Console\\Command\\GenerateCommand', 'execute');
        $execute->setAccessible(true);

        $execute->invoke($generate, $input, $output);

        $this->assertCount(1, $output->messages);
        $this->assertTrue(Uuid::isValid($output->messages[0]));
        $this->assertEquals(5, Uuid::fromString($output->messages[0])->getVersion());
        $this->assertEquals('886313e1-3b8a-5372-9b90-0c9aee199e5d', $output->messages[0]);
    }

    /**
     * @covers Ramsey\Uuid\Console\Command\GenerateCommand::execute
     * @covers Ramsey\Uuid\Console\Command\GenerateCommand::createUuid
     * @covers Ramsey\Uuid\Console\Command\GenerateCommand::validateNamespace
     */
    public function testExecuteForUuidSpecifyVersion5WithUrlNs()
    {
        $generate = new GenerateCommand();

        $input = new StringInput('5 ns:URL "http://python.org/"');
        $input->bind($generate->getDefinition());

        $output = new TestOutput();

        $execute = new \ReflectionMethod('Ramsey\\Uuid\\Console\\Command\\GenerateCommand', 'execute');
        $execute->setAccessible(true);

        $execute->invoke($generate, $input, $output);

        $this->assertCount(1, $output->messages);
        $this->assertTrue(Uuid::isValid($output->messages[0]));
        $this->assertEquals(5, Uuid::fromString($output->messages[0])->getVersion());
        $this->assertEquals('4c565f0d-3f5a-5890-b41b-20cf47701c5e', $output->messages[0]);
    }

    /**
     * @covers Ramsey\Uuid\Console\Command\GenerateCommand::execute
     * @covers Ramsey\Uuid\Console\Command\GenerateCommand::createUuid
     * @covers Ramsey\Uuid\Console\Command\GenerateCommand::validateNamespace
     */
    public function testExecuteForUuidSpecifyVersion5WithOidNs()
    {
        $generate = new GenerateCommand();

        $input = new StringInput('5 ns:OID "1.3.6.1"');
        $input->bind($generate->getDefinition());

        $output = new TestOutput();

        $execute = new \ReflectionMethod('Ramsey\\Uuid\\Console\\Command\\GenerateCommand', 'execute');
        $execute->setAccessible(true);

        $execute->invoke($generate, $input, $output);

        $this->assertCount(1, $output->messages);
        $this->assertTrue(Uuid::isValid($output->messages[0]));
        $this->assertEquals(5, Uuid::fromString($output->messages[0])->getVersion());
        $this->assertEquals('1447fa61-5277-5fef-a9b3-fbc6e44f4af3', $output->messages[0]);
    }

    /**
     * @covers Ramsey\Uuid\Console\Command\GenerateCommand::execute
     * @covers Ramsey\Uuid\Console\Command\GenerateCommand::createUuid
     * @covers Ramsey\Uuid\Console\Command\GenerateCommand::validateNamespace
     */
    public function testExecuteForUuidSpecifyVersion5WithX500Ns()
    {
        $generate = new GenerateCommand();

        $input = new StringInput('5 ns:X500 "c=ca"');
        $input->bind($generate->getDefinition());

        $output = new TestOutput();

        $execute = new \ReflectionMethod('Ramsey\\Uuid\\Console\\Command\\GenerateCommand', 'execute');
        $execute->setAccessible(true);

        $execute->invoke($generate, $input, $output);

        $this->assertCount(1, $output->messages);
        $this->assertTrue(Uuid::isValid($output->messages[0]));
        $this->assertEquals(5, Uuid::fromString($output->messages[0])->getVersion());
        $this->assertEquals('cc957dd1-a972-5349-98cd-874190002798', $output->messages[0]);
    }

    /**
     * @covers Ramsey\Uuid\Console\Command\GenerateCommand::execute
     * @covers Ramsey\Uuid\Console\Command\GenerateCommand::createUuid
     * @covers Ramsey\Uuid\Console\Command\GenerateCommand::validateNamespace
     */
    public function testExecuteForUuidSpecifyVersion5WithOtherNs()
    {
        $generate = new GenerateCommand();

        $input = new StringInput('5 bbd8a651-6f00-11e3-8ad8-28cfe91e4895 foobar');
        $input->bind($generate->getDefinition());

        $output = new TestOutput();

        $execute = new \ReflectionMethod('Ramsey\\Uuid\\Console\\Command\\GenerateCommand', 'execute');
        $execute->setAccessible(true);

        $execute->invoke($generate, $input, $output);

        $this->assertCount(1, $output->messages);
        $this->assertTrue(Uuid::isValid($output->messages[0]));
        $this->assertEquals(5, Uuid::fromString($output->messages[0])->getVersion());
        $this->assertEquals('385c280b-1d07-5d6b-932b-ca7a11d2e7e5', $output->messages[0]);
    }

    /**
     * @covers Ramsey\Uuid\Console\Command\GenerateCommand::execute
     * @covers Ramsey\Uuid\Console\Command\GenerateCommand::createUuid
     * @covers Ramsey\Uuid\Console\Command\GenerateCommand::validateNamespace
     */
    public function testExecuteForUuidSpecifyVersion5WithInvalidNs()
    {
        if (!method_exists($this, 'expectException')) {
            $this->markTestSkipped('This version of PHPUnit does not have expectException()');
        }

        $generate = new GenerateCommand();

        $input = new StringInput('5 foo foobar');
        $input->bind($generate->getDefinition());

        $output = new TestOutput();

        $execute = new \ReflectionMethod('Ramsey\\Uuid\\Console\\Command\\GenerateCommand', 'execute');
        $execute->setAccessible(true);

        $this->expectException('Ramsey\\Uuid\\Console\\Exception');
        $this->expectExceptionMessage('May be either a UUID in string representation or an identifier');

        $execute->invoke($generate, $input, $output);
    }

    /**
     * @covers Ramsey\Uuid\Console\Command\GenerateCommand::execute
     * @covers Ramsey\Uuid\Console\Command\GenerateCommand::createUuid
     * @covers Ramsey\Uuid\Console\Command\GenerateCommand::validateNamespace
     */
    public function testExecuteForUuidSpecifyVersion5WithCount()
    {
        $generate = new GenerateCommand();

        $input = new StringInput('5 ns:DNS "python.org" -c 21');
        $input->bind($generate->getDefinition());

        $output = new TestOutput();

        $execute = new \ReflectionMethod('Ramsey\\Uuid\\Console\\Command\\GenerateCommand', 'execute');
        $execute->setAccessible(true);

        $execute->invoke($generate, $input, $output);

        $this->assertCount(21, $output->messages);

        foreach ($output->messages as $uuid) {
            $this->assertTrue(Uuid::isValid($uuid));
            $this->assertEquals(5, Uuid::fromString($uuid)->getVersion());
            $this->assertEquals('886313e1-3b8a-5372-9b90-0c9aee199e5d', $uuid);
        }
    }

    /**
     * @covers Ramsey\Uuid\Console\Command\GenerateCommand::execute
     * @covers Ramsey\Uuid\Console\Command\GenerateCommand::createUuid
     * @covers Ramsey\Uuid\Console\Command\GenerateCommand::validateNamespace
     */
    public function testExecuteForUuidSpecifyVersion5WithoutName()
    {
        $generate = new GenerateCommand();

        $input = new StringInput('5 ns:DNS');
        $input->bind($generate->getDefinition());

        $output = new TestOutput();

        $execute = new \ReflectionMethod('Ramsey\\Uuid\\Console\\Command\\GenerateCommand', 'execute');
        $execute->setAccessible(true);

        $execute->invoke($generate, $input, $output);

        $this->assertCount(1, $output->messages);

        foreach ($output->messages as $uuid) {
            $this->assertTrue(Uuid::isValid($uuid));
            $this->assertEquals(5, Uuid::fromString($uuid)->getVersion());
            $this->assertEquals('4ebd0208-8328-5d69-8c44-ec50939c0967', $uuid);
        }
    }

    /**
     * @covers Ramsey\Uuid\Console\Command\GenerateCommand::execute
     * @covers Ramsey\Uuid\Console\Command\GenerateCommand::createUuid
     */
    public function testExecuteForUuidSpecifyInvalidVersion()
    {
        if (!method_exists($this, 'expectException')) {
            $this->markTestSkipped('This version of PHPUnit does not have expectException()');
        }

        $generate = new GenerateCommand();

        $input = new StringInput('7');
        $input->bind($generate->getDefinition());

        $output = new TestOutput();

        $execute = new \ReflectionMethod('Ramsey\\Uuid\\Console\\Command\\GenerateCommand', 'execute');
        $execute->setAccessible(true);

        $this->expectException('Ramsey\\Uuid\\Console\\Exception');
        $this->expectExceptionMessage('Invalid UUID version. Supported are version "1", "3", "4", "5" and "6".');

        $execute->invoke($generate, $input, $output);
    }
}
