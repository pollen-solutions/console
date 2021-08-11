<?php

declare(strict_types=1);

namespace Pollen\Console;

class CallableCommand extends Command
{
    /**
     * Callable command to execute.
     * @var callable
     */
    protected $callable;

    /**
     * @param callable $callable
     */
    public function __construct(callable $callable)
    {
        $this->callable = $callable;

        parent::__construct();
    }

    /**
     * @param CommandInputInterface $input
     * @param CommandOutputInterface $output
     *
     * @return mixed
     */
    public function __invoke(CommandInputInterface $input, CommandOutputInterface $output)
    {
        return ($this->callable)($this);
    }
}
