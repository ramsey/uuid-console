<?php

declare(strict_types=1);

namespace Ramsey\Uuid\Console\Command;

use Ramsey\Uuid\Console\Exception;
use Ramsey\Uuid\Console\TestCase;
use Ramsey\Uuid\Console\Util\TestOutput;
use Ramsey\Uuid\Uuid;
use ReflectionMethod;
use Symfony\Component\Console\Input\StringInput;

use function method_exists;

class GenerateCommandTest extends TestCase
{
    public const FOO_NS = 'bbd8a651-6f00-11e3-8ad8-28cfe91e4895';

    public function testConfigure(): void
    {
        $generate = new GenerateCommand();

        $this->assertSame('generate', $generate->getName());
        $this->assertSame('Generate a UUID', $generate->getDescription());
    }

    public function testExecuteForUuidDefault(): void
    {
        $generate = new GenerateCommand();

        $input = new StringInput('');
        $input->bind($generate->getDefinition());

        $output = new TestOutput();

        $execute = new ReflectionMethod(GenerateCommand::class, 'execute');
        $execute->setAccessible(true);

        $execute->invoke($generate, $input, $output);

        $this->assertCount(1, $output->messages);
        $this->assertTrue(Uuid::isValid($output->messages[0]));
        $this->assertSame(1, Uuid::fromString($output->messages[0])->getVersion());
    }

    public function testExecuteForUuidDefaultWithCount(): void
    {
        $generate = new GenerateCommand();

        // Test using the "-c" option
        $input1 = new StringInput('-c 9');
        $input1->bind($generate->getDefinition());

        $output1 = new TestOutput();

        $execute = new ReflectionMethod(GenerateCommand::class, 'execute');
        $execute->setAccessible(true);

        $execute->invoke($generate, $input1, $output1);

        $this->assertCount(9, $output1->messages);

        foreach ($output1->messages as $uuid) {
            $this->assertTrue(Uuid::isValid($uuid));
            $this->assertSame(1, Uuid::fromString($uuid)->getVersion());
        }

        // Test using the "--count" option
        $input2 = new StringInput('--count=12');
        $input2->bind($generate->getDefinition());

        $output2 = new TestOutput();

        $execute = new ReflectionMethod(GenerateCommand::class, 'execute');
        $execute->setAccessible(true);

        $execute->invoke($generate, $input2, $output2);

        $this->assertCount(12, $output2->messages);

        foreach ($output2->messages as $uuid) {
            $this->assertTrue(Uuid::isValid($uuid));
            $this->assertSame(1, Uuid::fromString($uuid)->getVersion());
        }
    }

    public function testExecuteForUuidSpecifyVersion1(): void
    {
        $generate = new GenerateCommand();

        $input = new StringInput('1');
        $input->bind($generate->getDefinition());

        $output = new TestOutput();

        $execute = new ReflectionMethod(GenerateCommand::class, 'execute');
        $execute->setAccessible(true);

        $execute->invoke($generate, $input, $output);

        $this->assertCount(1, $output->messages);
        $this->assertTrue(Uuid::isValid($output->messages[0]));
        $this->assertSame(1, Uuid::fromString($output->messages[0])->getVersion());
    }

    public function testExecuteForUuidSpecifyVersion1WithCount(): void
    {
        $generate = new GenerateCommand();

        // Test using the "-c" option
        $input1 = new StringInput('1 -c 3');
        $input1->bind($generate->getDefinition());

        $output1 = new TestOutput();

        $execute = new ReflectionMethod(GenerateCommand::class, 'execute');
        $execute->setAccessible(true);

        $execute->invoke($generate, $input1, $output1);

        $this->assertCount(3, $output1->messages);

        foreach ($output1->messages as $uuid) {
            $this->assertTrue(Uuid::isValid($uuid));
            $this->assertSame(1, Uuid::fromString($uuid)->getVersion());
        }

        // Test using the "--count" option
        $input2 = new StringInput('1 --count=8');
        $input2->bind($generate->getDefinition());

        $output2 = new TestOutput();

        $execute = new ReflectionMethod(GenerateCommand::class, 'execute');
        $execute->setAccessible(true);

        $execute->invoke($generate, $input2, $output2);

        $this->assertCount(8, $output2->messages);

        foreach ($output2->messages as $uuid) {
            $this->assertTrue(Uuid::isValid($uuid));
            $this->assertSame(1, Uuid::fromString($uuid)->getVersion());
        }
    }

    public function testExecuteForUuidSpecifyVersion4(): void
    {
        $generate = new GenerateCommand();

        $input = new StringInput('4');
        $input->bind($generate->getDefinition());

        $output = new TestOutput();

        $execute = new ReflectionMethod(GenerateCommand::class, 'execute');
        $execute->setAccessible(true);

        $execute->invoke($generate, $input, $output);

        $this->assertCount(1, $output->messages);
        $this->assertTrue(Uuid::isValid($output->messages[0]));
        $this->assertSame(4, Uuid::fromString($output->messages[0])->getVersion());
    }

    public function testExecuteForUuidSpecifyVersion4WithCount(): void
    {
        $generate = new GenerateCommand();

        // Test using the "-c" option
        $input1 = new StringInput('4 -c 3');
        $input1->bind($generate->getDefinition());

        $output1 = new TestOutput();

        $execute = new ReflectionMethod(GenerateCommand::class, 'execute');
        $execute->setAccessible(true);

        $execute->invoke($generate, $input1, $output1);

        $this->assertCount(3, $output1->messages);

        foreach ($output1->messages as $uuid) {
            $this->assertTrue(Uuid::isValid($uuid));
            $this->assertSame(4, Uuid::fromString($uuid)->getVersion());
        }

        // Test using the "--count" option
        $input2 = new StringInput('4 --count=8');
        $input2->bind($generate->getDefinition());

        $output2 = new TestOutput();

        $execute = new ReflectionMethod(GenerateCommand::class, 'execute');
        $execute->setAccessible(true);

        $execute->invoke($generate, $input2, $output2);

        $this->assertCount(8, $output2->messages);

        foreach ($output2->messages as $uuid) {
            $this->assertTrue(Uuid::isValid($uuid));
            $this->assertSame(4, Uuid::fromString($uuid)->getVersion());
        }
    }

    public function testExecuteForUuidSpecifyVersion6(): void
    {
        if (!method_exists(Uuid::class, 'uuid6')) {
            $this->markTestSkipped('Skipping for version of ramsey/uuid that does not support uuid6');
        }

        $generate = new GenerateCommand();

        $input = new StringInput('6');
        $input->bind($generate->getDefinition());

        $output = new TestOutput();

        $execute = new ReflectionMethod(GenerateCommand::class, 'execute');
        $execute->setAccessible(true);

        $execute->invoke($generate, $input, $output);

        $this->assertCount(1, $output->messages);
        $this->assertTrue(Uuid::isValid($output->messages[0]));
        $this->assertSame(6, Uuid::fromString($output->messages[0])->getVersion());
    }

    public function testExecuteForUuidSpecifyVersion6WithCount(): void
    {
        if (!method_exists(Uuid::class, 'uuid6')) {
            $this->markTestSkipped('Skipping for version of ramsey/uuid that does not support uuid6');
        }

        $generate = new GenerateCommand();

        // Test using the "-c" option
        $input1 = new StringInput('6 -c 3');
        $input1->bind($generate->getDefinition());

        $output1 = new TestOutput();

        $execute = new ReflectionMethod(GenerateCommand::class, 'execute');
        $execute->setAccessible(true);

        $execute->invoke($generate, $input1, $output1);

        $this->assertCount(3, $output1->messages);

        foreach ($output1->messages as $uuid) {
            $this->assertTrue(Uuid::isValid($uuid));
            $this->assertSame(6, Uuid::fromString($uuid)->getVersion());
        }

        // Test using the "--count" option
        $input2 = new StringInput('6 --count=8');
        $input2->bind($generate->getDefinition());

        $output2 = new TestOutput();

        $execute = new ReflectionMethod(GenerateCommand::class, 'execute');
        $execute->setAccessible(true);

        $execute->invoke($generate, $input2, $output2);

        $this->assertCount(8, $output2->messages);

        foreach ($output2->messages as $uuid) {
            $this->assertTrue(Uuid::isValid($uuid));
            $this->assertSame(6, Uuid::fromString($uuid)->getVersion());
        }
    }

    public function testExecuteForUuidSpecifyVersion6OnUnsupportedVersion(): void
    {
        if (method_exists(Uuid::class, 'uuid6')) {
            $this->markTestSkipped('Skipping for version of ramsey/uuid that supports uuid6');
        }

        $generate = new GenerateCommand();

        $input1 = new StringInput('6');
        $input1->bind($generate->getDefinition());

        $output1 = new TestOutput();

        $execute = new ReflectionMethod(GenerateCommand::class, 'execute');
        $execute->setAccessible(true);

        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Your version of ramsey/uuid does not support uuid6.');

        $execute->invoke($generate, $input1, $output1);
    }

    public function testExecuteForUuidSpecifyVersion3WithDnsNs(): void
    {
        $generate = new GenerateCommand();

        $input = new StringInput('3 ns:DNS "python.org"');
        $input->bind($generate->getDefinition());

        $output = new TestOutput();

        $execute = new ReflectionMethod(GenerateCommand::class, 'execute');
        $execute->setAccessible(true);

        $execute->invoke($generate, $input, $output);

        $this->assertCount(1, $output->messages);
        $this->assertTrue(Uuid::isValid($output->messages[0]));
        $this->assertSame(3, Uuid::fromString($output->messages[0])->getVersion());
        $this->assertSame('6fa459ea-ee8a-3ca4-894e-db77e160355e', $output->messages[0]);
    }

    public function testExecuteForUuidSpecifyVersion3WithUrlNs(): void
    {
        $generate = new GenerateCommand();

        $input = new StringInput('3 ns:URL "http://python.org/"');
        $input->bind($generate->getDefinition());

        $output = new TestOutput();

        $execute = new ReflectionMethod(GenerateCommand::class, 'execute');
        $execute->setAccessible(true);

        $execute->invoke($generate, $input, $output);

        $this->assertCount(1, $output->messages);
        $this->assertTrue(Uuid::isValid($output->messages[0]));
        $this->assertSame(3, Uuid::fromString($output->messages[0])->getVersion());
        $this->assertSame('9fe8e8c4-aaa8-32a9-a55c-4535a88b748d', $output->messages[0]);
    }

    public function testExecuteForUuidSpecifyVersion3WithOidNs(): void
    {
        $generate = new GenerateCommand();

        $input = new StringInput('3 ns:OID "1.3.6.1"');
        $input->bind($generate->getDefinition());

        $output = new TestOutput();

        $execute = new ReflectionMethod(GenerateCommand::class, 'execute');
        $execute->setAccessible(true);

        $execute->invoke($generate, $input, $output);

        $this->assertCount(1, $output->messages);
        $this->assertTrue(Uuid::isValid($output->messages[0]));
        $this->assertSame(3, Uuid::fromString($output->messages[0])->getVersion());
        $this->assertSame('dd1a1cef-13d5-368a-ad82-eca71acd4cd1', $output->messages[0]);
    }

    public function testExecuteForUuidSpecifyVersion3WithX500Ns(): void
    {
        $generate = new GenerateCommand();

        $input = new StringInput('3 ns:X500 "c=ca"');
        $input->bind($generate->getDefinition());

        $output = new TestOutput();

        $execute = new ReflectionMethod(GenerateCommand::class, 'execute');
        $execute->setAccessible(true);

        $execute->invoke($generate, $input, $output);

        $this->assertCount(1, $output->messages);
        $this->assertTrue(Uuid::isValid($output->messages[0]));
        $this->assertSame(3, Uuid::fromString($output->messages[0])->getVersion());
        $this->assertSame('658d3002-db6b-3040-a1d1-8ddd7d189a4d', $output->messages[0]);
    }

    public function testExecuteForUuidSpecifyVersion3WithOtherNs(): void
    {
        $generate = new GenerateCommand();

        $input = new StringInput('3 bbd8a651-6f00-11e3-8ad8-28cfe91e4895 foobar');
        $input->bind($generate->getDefinition());

        $output = new TestOutput();

        $execute = new ReflectionMethod(GenerateCommand::class, 'execute');
        $execute->setAccessible(true);

        $execute->invoke($generate, $input, $output);

        $this->assertCount(1, $output->messages);
        $this->assertTrue(Uuid::isValid($output->messages[0]));
        $this->assertSame(3, Uuid::fromString($output->messages[0])->getVersion());
        $this->assertSame('0707b2c0-1f0f-3b2b-9a90-371396a90a86', $output->messages[0]);
    }

    public function testExecuteForUuidSpecifyVersion3WithInvalidNs(): void
    {
        $generate = new GenerateCommand();

        $input = new StringInput('3 foo foobar');
        $input->bind($generate->getDefinition());

        $output = new TestOutput();

        $execute = new ReflectionMethod(GenerateCommand::class, 'execute');
        $execute->setAccessible(true);

        $this->expectException(Exception::class);
        $this->expectExceptionMessage('May be either a UUID in string representation or an identifier');

        $execute->invoke($generate, $input, $output);
    }

    public function testExecuteForUuidSpecifyVersion3WithCount(): void
    {
        $generate = new GenerateCommand();

        $input = new StringInput('3 ns:DNS "python.org" -c 21');
        $input->bind($generate->getDefinition());

        $output = new TestOutput();

        $execute = new ReflectionMethod(GenerateCommand::class, 'execute');
        $execute->setAccessible(true);

        $execute->invoke($generate, $input, $output);

        $this->assertCount(21, $output->messages);

        foreach ($output->messages as $uuid) {
            $this->assertTrue(Uuid::isValid($uuid));
            $this->assertSame(3, Uuid::fromString($uuid)->getVersion());
            $this->assertSame('6fa459ea-ee8a-3ca4-894e-db77e160355e', $uuid);
        }
    }

    public function testExecuteForUuidSpecifyVersion3WithoutName(): void
    {
        $generate = new GenerateCommand();

        $input = new StringInput('3 ns:DNS');
        $input->bind($generate->getDefinition());

        $output = new TestOutput();

        $execute = new ReflectionMethod(GenerateCommand::class, 'execute');
        $execute->setAccessible(true);

        $execute->invoke($generate, $input, $output);

        $this->assertCount(1, $output->messages);

        foreach ($output->messages as $uuid) {
            $this->assertTrue(Uuid::isValid($uuid));
            $this->assertSame(3, Uuid::fromString($uuid)->getVersion());
            $this->assertSame('c87ee674-4ddc-3efe-a74e-dfe25da5d7b3', $uuid);
        }
    }

    public function testExecuteForUuidSpecifyVersion5WithDnsNs(): void
    {
        $generate = new GenerateCommand();

        $input = new StringInput('5 ns:DNS "python.org"');
        $input->bind($generate->getDefinition());

        $output = new TestOutput();

        $execute = new ReflectionMethod(GenerateCommand::class, 'execute');
        $execute->setAccessible(true);

        $execute->invoke($generate, $input, $output);

        $this->assertCount(1, $output->messages);
        $this->assertTrue(Uuid::isValid($output->messages[0]));
        $this->assertSame(5, Uuid::fromString($output->messages[0])->getVersion());
        $this->assertSame('886313e1-3b8a-5372-9b90-0c9aee199e5d', $output->messages[0]);
    }

    public function testExecuteForUuidSpecifyVersion5WithUrlNs(): void
    {
        $generate = new GenerateCommand();

        $input = new StringInput('5 ns:URL "http://python.org/"');
        $input->bind($generate->getDefinition());

        $output = new TestOutput();

        $execute = new ReflectionMethod(GenerateCommand::class, 'execute');
        $execute->setAccessible(true);

        $execute->invoke($generate, $input, $output);

        $this->assertCount(1, $output->messages);
        $this->assertTrue(Uuid::isValid($output->messages[0]));
        $this->assertSame(5, Uuid::fromString($output->messages[0])->getVersion());
        $this->assertSame('4c565f0d-3f5a-5890-b41b-20cf47701c5e', $output->messages[0]);
    }

    public function testExecuteForUuidSpecifyVersion5WithOidNs(): void
    {
        $generate = new GenerateCommand();

        $input = new StringInput('5 ns:OID "1.3.6.1"');
        $input->bind($generate->getDefinition());

        $output = new TestOutput();

        $execute = new ReflectionMethod(GenerateCommand::class, 'execute');
        $execute->setAccessible(true);

        $execute->invoke($generate, $input, $output);

        $this->assertCount(1, $output->messages);
        $this->assertTrue(Uuid::isValid($output->messages[0]));
        $this->assertSame(5, Uuid::fromString($output->messages[0])->getVersion());
        $this->assertSame('1447fa61-5277-5fef-a9b3-fbc6e44f4af3', $output->messages[0]);
    }

    public function testExecuteForUuidSpecifyVersion5WithX500Ns(): void
    {
        $generate = new GenerateCommand();

        $input = new StringInput('5 ns:X500 "c=ca"');
        $input->bind($generate->getDefinition());

        $output = new TestOutput();

        $execute = new ReflectionMethod(GenerateCommand::class, 'execute');
        $execute->setAccessible(true);

        $execute->invoke($generate, $input, $output);

        $this->assertCount(1, $output->messages);
        $this->assertTrue(Uuid::isValid($output->messages[0]));
        $this->assertSame(5, Uuid::fromString($output->messages[0])->getVersion());
        $this->assertSame('cc957dd1-a972-5349-98cd-874190002798', $output->messages[0]);
    }

    public function testExecuteForUuidSpecifyVersion5WithOtherNs(): void
    {
        $generate = new GenerateCommand();

        $input = new StringInput('5 bbd8a651-6f00-11e3-8ad8-28cfe91e4895 foobar');
        $input->bind($generate->getDefinition());

        $output = new TestOutput();

        $execute = new ReflectionMethod(GenerateCommand::class, 'execute');
        $execute->setAccessible(true);

        $execute->invoke($generate, $input, $output);

        $this->assertCount(1, $output->messages);
        $this->assertTrue(Uuid::isValid($output->messages[0]));
        $this->assertSame(5, Uuid::fromString($output->messages[0])->getVersion());
        $this->assertSame('385c280b-1d07-5d6b-932b-ca7a11d2e7e5', $output->messages[0]);
    }

    public function testExecuteForUuidSpecifyVersion5WithInvalidNs(): void
    {
        $generate = new GenerateCommand();

        $input = new StringInput('5 foo foobar');
        $input->bind($generate->getDefinition());

        $output = new TestOutput();

        $execute = new ReflectionMethod(GenerateCommand::class, 'execute');
        $execute->setAccessible(true);

        $this->expectException(Exception::class);
        $this->expectExceptionMessage('May be either a UUID in string representation or an identifier');

        $execute->invoke($generate, $input, $output);
    }

    public function testExecuteForUuidSpecifyVersion5WithCount(): void
    {
        $generate = new GenerateCommand();

        $input = new StringInput('5 ns:DNS "python.org" -c 21');
        $input->bind($generate->getDefinition());

        $output = new TestOutput();

        $execute = new ReflectionMethod(GenerateCommand::class, 'execute');
        $execute->setAccessible(true);

        $execute->invoke($generate, $input, $output);

        $this->assertCount(21, $output->messages);

        foreach ($output->messages as $uuid) {
            $this->assertTrue(Uuid::isValid($uuid));
            $this->assertSame(5, Uuid::fromString($uuid)->getVersion());
            $this->assertSame('886313e1-3b8a-5372-9b90-0c9aee199e5d', $uuid);
        }
    }

    public function testExecuteForUuidSpecifyVersion5WithoutName(): void
    {
        $generate = new GenerateCommand();

        $input = new StringInput('5 ns:DNS');
        $input->bind($generate->getDefinition());

        $output = new TestOutput();

        $execute = new ReflectionMethod(GenerateCommand::class, 'execute');
        $execute->setAccessible(true);

        $execute->invoke($generate, $input, $output);

        $this->assertCount(1, $output->messages);

        foreach ($output->messages as $uuid) {
            $this->assertTrue(Uuid::isValid($uuid));
            $this->assertSame(5, Uuid::fromString($uuid)->getVersion());
            $this->assertSame('4ebd0208-8328-5d69-8c44-ec50939c0967', $uuid);
        }
    }

    public function testExecuteForUuidSpecifyInvalidVersion(): void
    {
        $generate = new GenerateCommand();

        $input = new StringInput('9');
        $input->bind($generate->getDefinition());

        $output = new TestOutput();

        $execute = new ReflectionMethod(GenerateCommand::class, 'execute');
        $execute->setAccessible(true);

        $this->expectException(Exception::class);
        $this->expectExceptionMessage(
            'Invalid UUID version. Supported are version "1", "3", "4", "5", "6", and "7".',
        );

        $execute->invoke($generate, $input, $output);
    }

    public function testExecuteForUuidSpecifyVersion7(): void
    {
        if (!method_exists(Uuid::class, 'uuid7')) {
            $this->markTestSkipped('Skipping for version of ramsey/uuid that does not support uuid7');
        }

        $generate = new GenerateCommand();

        $input = new StringInput('7');
        $input->bind($generate->getDefinition());

        $output = new TestOutput();

        $execute = new ReflectionMethod(GenerateCommand::class, 'execute');
        $execute->setAccessible(true);

        $execute->invoke($generate, $input, $output);

        $this->assertCount(1, $output->messages);
        $this->assertTrue(Uuid::isValid($output->messages[0]));
        $this->assertSame(7, Uuid::fromString($output->messages[0])->getVersion());
    }

    public function testExecuteForUuidSpecifyVersion7WithCount(): void
    {
        if (!method_exists(Uuid::class, 'uuid7')) {
            $this->markTestSkipped('Skipping for version of ramsey/uuid that does not support uuid7');
        }

        $generate = new GenerateCommand();

        // Test using the "-c" option
        $input1 = new StringInput('7 -c 3');
        $input1->bind($generate->getDefinition());

        $output1 = new TestOutput();

        $execute = new ReflectionMethod(GenerateCommand::class, 'execute');
        $execute->setAccessible(true);

        $execute->invoke($generate, $input1, $output1);

        $this->assertCount(3, $output1->messages);

        foreach ($output1->messages as $uuid) {
            $this->assertTrue(Uuid::isValid($uuid));
            $this->assertSame(7, Uuid::fromString($uuid)->getVersion());
        }

        // Test using the "--count" option
        $input2 = new StringInput('7 --count=8');
        $input2->bind($generate->getDefinition());

        $output2 = new TestOutput();

        $execute = new ReflectionMethod(GenerateCommand::class, 'execute');
        $execute->setAccessible(true);

        $execute->invoke($generate, $input2, $output2);

        $this->assertCount(8, $output2->messages);

        foreach ($output2->messages as $uuid) {
            $this->assertTrue(Uuid::isValid($uuid));
            $this->assertSame(7, Uuid::fromString($uuid)->getVersion());
        }
    }

    public function testExecuteForUuidSpecifyVersion7OnUnsupportedVersion(): void
    {
        if (method_exists(Uuid::class, 'uuid7')) {
            $this->markTestSkipped('Skipping for version of ramsey/uuid that supports uuid7');
        }

        $generate = new GenerateCommand();

        $input1 = new StringInput('7');
        $input1->bind($generate->getDefinition());

        $output1 = new TestOutput();

        $execute = new ReflectionMethod(GenerateCommand::class, 'execute');
        $execute->setAccessible(true);

        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Your version of ramsey/uuid does not support uuid7.');

        $execute->invoke($generate, $input1, $output1);
    }
}
