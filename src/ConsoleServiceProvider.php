<?php

declare(strict_types=1);

namespace Pollen\Console;

use Pollen\Container\ServiceProvider;

class ConsoleServiceProvider extends ServiceProvider
{
    protected $provides = [
        ConsoleInterface::class
    ];

    /**
     * @inheritDoc
     */
    public function register(): void
    {
        $this->getContainer()->share(ConsoleInterface::class, function () {
            return new Console([], $this->getContainer());
        });
    }
}