<?php

declare(strict_types=1);

namespace Pollen\Console;

interface StackCommandInterface extends CommandInterface
{
    /**
     * Add a new command in the stack by its name.
     *
     * @param string $name
     *
     * @return static
     */
    public function addCommand(string $name): StackCommandInterface;
}