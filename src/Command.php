<?php

declare(strict_types=1);

namespace Pollen\Console;

use Symfony\Component\Console\Command\Command as BaseCommand;
use Symfony\Component\Console\Helper\TableSeparator;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Command extends BaseCommand implements CommandInterface
{
    /**
     * Command input instance.
     * @var CommandInputInterface|null
     */
    protected ?InputInterface $input = null;

    /**
     * Command output instance.
     * @var CommandOutputInterface|null
     */
    protected ?OutputInterface $output = null;

    /**
     * INPUT METHODS
     * -----------------------------------------------------------------------------------------------------------------
     */
    /**
     * @inheritDoc
     */
    public function getArgument(?string $key = null)
    {
        if ($key === null) {
            return $this->input->getArguments();
        }

        return $this->input->getArgument($key);
    }

    /**
     * @inheritDoc
     */
    public function getOption(?string $key = null)
    {
        if ($key === null) {
            return $this->input->getOptions();
        }

        return $this->input->getOption($key);
    }

    /**
     * @inheritDoc
     */
    public function hasArgument(string $name): bool
    {
        return $this->input->hasArgument($name);
    }

    /**
     * @inheritDoc
     */
    public function hasOption(string $name): bool
    {
        return $this->input->hasOption($name);
    }

    /**
     * OUTPUT METHODS
     * -----------------------------------------------------------------------------------------------------------------
     */
    /**
     * @inheritDoc
     */
    public function ask(string $question, ?string $default = null, ?callable $validator = null)
    {
        return $this->output->ask($question, $default, $validator);
    }

    /**
     * @inheritDoc
     */
    public function askHidden(string $question, ?callable $validator = null)
    {
        return $this->output->askHidden($question, $validator);
    }

    /**
     * @inheritDoc
     */
    public function caution($message): void
    {
        $this->output->caution($message);
    }

    /**
     * @inheritDoc
     */
    public function choice(string $question, array $choices, $default = null)
    {
        return $this->output->choice($question, $choices, $default);
    }

    /**
     * @inheritDoc
     */
    public function comment($message): void
    {
        $this->output->comment($message);
    }

    /**
     * @inheritDoc
     */
    public function confirm(string $question, bool $default = true): bool
    {
        return $this->output->confirm($question, $default);
    }

    /**
     * @inheritDoc
     */
    public function definitionList(...$list): void
    {
        $this->output->definitionList(...$list);
    }

    /**
     * @inheritDoc
     */
    public function definitionListSeparator(...$list): TableSeparator
    {
        return new TableSeparator();
    }

    /**
     * @inheritDoc
     */
    public function error($message): void
    {
        $this->output->error($message);
    }

    /**
     * @inheritDoc
     */
    public function horizontalTable(array $headers, array $rows): void
    {
        $this->output->horizontalTable($headers, $rows);
    }

    /**
     * @inheritDoc
     */
    public function info($message): void
    {
        $this->output->info($message);
    }

    /**
     * @inheritDoc
     */
    public function listing(array $elements): void
    {
        $this->output->listing($elements);
    }

    /**
     * @inheritDoc
     */
    public function newLine(int $count = 1): void
    {
        $this->output->newLine($count);
    }

    /**
     * @inheritDoc
     */
    public function note($message): void
    {
        $this->output->note($message);
    }

    /**
     * @inheritDoc
     */
    public function progressStart(int $max = 0): void
    {
        $this->output->progressStart($max);
    }

    /**
     * @inheritDoc
     */
    public function progressAdvance(int $step = 1): void
    {
        $this->output->progressAdvance($step);
    }

    /**
     * @inheritDoc
     */
    public function progressFinish(): void
    {
        $this->output->progressFinish();
    }

    /**
     * @inheritDoc
     */
    public function section(string $message): void
    {
        $this->output->section($message);
    }

    /**
     * @inheritDoc
     */
    public function success($message): void
    {
        $this->output->success($message);
    }

    /**
     * @inheritDoc
     */
    public function table(array $headers, array $rows): void
    {
        $this->output->table($headers, $rows);
    }

    /**
     * @inheritDoc
     */
    public function text($message): void
    {
        $this->output->text($message);
    }

    /**
     * @inheritDoc
     */
    public function title(string $message): void
    {
        $this->output->title($message);
    }

    /**
     * @inheritDoc
     */
    public function warning($message): void
    {
        $this->output->warning($message);
    }

    /**
     * COMMAND METHODS
     * -----------------------------------------------------------------------------------------------------------------
     */
    /**
     * Execute the console command.
     *
     * @return int
     */
    protected function exec(): int
    {
        return $this::SUCCESS;
    }

    /**
     * @inheritDoc
     *
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        return $this->exec();
    }

    /**
     * @inheritDoc
     */
    public function run(InputInterface $input, OutputInterface $output): int
    {
        $this->input = $input;
        $this->output = $output;

        return parent::run($this->input, $this->output);
    }
}