<?php

namespace Ramsey\Uuid\Console;

class ApplicationTest extends TestCase
{
    /**
     * @covers Ramsey\Uuid\Console\Application::__construct
     */
    public function testConstructor()
    {
        $app = new Application();

        // Reset the error handler, since the constructor sets it
        restore_error_handler();

        $this->assertInstanceOf('Ramsey\\Uuid\\Console\\Application', $app);
        $this->assertSame('ramsey/uuid-console', $app->getName());
    }
}
