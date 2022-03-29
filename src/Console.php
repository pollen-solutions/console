<?php

declare(strict_types=1);

namespace Pollen\Console;

use Pollen\Support\Exception\ManagerRuntimeException;
use Pollen\Support\Proxy\ContainerProxy;
use Psr\Container\ContainerInterface as Container;
use RuntimeException;
use Symfony\Component\Console\Output\ConsoleOutput;

class Console implements ConsoleInterface
{
    use ContainerProxy;

    /**
     * Console main instance.
     * @var static|null
     */
    private static ?ConsoleInterface $instance = null;

    /**
     * Commands runner instance.
     * @var CommandsRunnerInterface|null
     */
    public ?CommandsRunnerInterface $runner = null;

    /**
     * @param Container|null $container
     */
    public function __construct(?Container $container = null)
    {
        if ($container !== null) {
            $this->setContainer($container);
        }

        if (!self::$instance instanceof static) {
            self::$instance = $this;
        }
    }

    /**
     * Get Console main instance.
     *
     * @return static
     */
    public static function getInstance(): ConsoleInterface
    {
        if (self::$instance instanceof self) {
            return self::$instance;
        }
        throw new ManagerRuntimeException(sprintf('Unavailable [%s] instance', __CLASS__));
    }

    /**
     * @inheritDoc
     */
    public function addCommand($commandDef, ?string $name = null): CommandInterface
    {
        if (is_string($commandDef) && $this->containerHas($commandDef)) {
            $commandDef = $this->containerGet($commandDef);
        }

        if (is_a($commandDef, CommandInterface::class)) {
            $command = !is_object($commandDef) ? new $commandDef() : $commandDef;
        } elseif (is_callable($commandDef)) {
            $command = new CallableCommand($commandDef);
            $command->setCode($command);
        } else {
            throw new RuntimeException('Command could not be added, the command definition type is invalid.');
        }

        if ($name === null) {
            $name = $command->getName();
        } else {
            $command->setName($name);
        }

        if (empty($name)) {
            throw new RuntimeException('invalid name');
        }

        $this->getRunner()->add($command);

        return $command;
    }

    /**
     * @inheritDoc
     */
    public function addStack($stackDef, ?string $name = null): StackCommandInterface
    {
        if (is_string($stackDef) && $this->containerHas($stackDef)) {
            $stackDef = $this->containerGet($stackDef);
        }

        if (is_a($stackDef, StackCommandInterface::class)) {
            $stack = !is_object($stackDef) ? new $stackDef() : $stackDef;
        } elseif (is_array($stackDef)) {
            $stack = new StackCommand();
            foreach($stackDef as $commandName) {
                $stack->addCommand($commandName);
            }
        } else {
            throw new RuntimeException(
                'Stack command could not be added, the commandstack  definition type is invalid.'
            );
        }

        $this->addCommand($stack, $name);

        return $stack;
    }

    /**
     * @inheritDoc
     */
    public function getRunner(): CommandsRunnerInterface
    {
        if ($this->runner === null) {
            $this->runner = new CommandsRunner();
        }
        return $this->runner;
    }

    /**
     * @inheritDoc
     */
    public function run(): int
    {
        return $this->getRunner()->run(
            $input = new CommandArgvInput(), new CommandOutput($input, new ConsoleOutput())
        );
    }
}