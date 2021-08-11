<?php

declare(strict_types=1);

namespace Pollen\Console;

use Pollen\Support\Concerns\ConfigBagAwareTraitInterface;
use Pollen\Support\Proxy\ContainerProxyInterface;

interface ConsoleInterface extends ConfigBagAwareTraitInterface, ContainerProxyInterface
{
    /**
     * Add a command.
     *
     * @param CommandInterface|callable|string $commandDef
     * @param string|null $name
     *
     * @return CommandInterface
     */
    public function addCommand($commandDef, ?string $name = null): CommandInterface;

    /**
     * Add a stack command.
     *
     * @param StackCommandInterface|array|string $stackDef
     * @param string|null $name
     *
     * @return StackCommandInterface
     */
    public function addStack($stackDef, ?string $name = null): StackCommandInterface;

    /**
     * Get command runner instance.
     *
     * @return CommandsRunnerInterface
     */
    public function getRunner(): CommandsRunnerInterface;

    /**
     * Run command.
     *
     * @return mixed
     */
    public function run();
}