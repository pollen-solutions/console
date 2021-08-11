<?php

declare(strict_types=1);

namespace Pollen\Console;

use Exception;
use Symfony\Component\Console\Exception\CommandNotFoundException;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use RuntimeException;

class StackCommand extends Command implements StackCommandInterface
{
    /**
     * List of related commands name.
     * @var string[]
     */
    protected array $commandNames = [];

    /**
     * @inheritDoc
     *
     * @throws Exception
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        if (!$application = $this->getApplication()) {
            throw new RuntimeException(
                'Stack command requires a valid Command runner (Application).'
            );
        }

        foreach ($this->commandNames as $name) {
            try {
                $command = $application->find($name);
            } catch (CommandNotFoundException $e) {
                throw new RuntimeException(sprintf('Command [%s] could not found.', $name), 0, $e);
            }

            try {
                $command->run($input, $output);
            } catch (Exception $e) {
                throw new RuntimeException(sprintf('Command [%s] could not run.', $name), 0, $e);
            }
        }

        return $this::SUCCESS;
    }

    /**
     * @inheritDoc
     */
    public function addCommand(string $name): StackCommandInterface
    {
        if (!in_array($name, $this->commandNames, true)) {
            $this->commandNames[] = $name;
        }

        return $this;
    }
}