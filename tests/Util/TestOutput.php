<?php

declare(strict_types=1);

namespace Ramsey\Uuid\Console\Util;

use Symfony\Component\Console\Output\Output;

class TestOutput extends Output
{
    /**
     * @var string[]
     */
    public array $messages = [];

    protected function doWrite(string $message, bool $newline): void
    {
        $this->messages[] = $message;
    }
}
