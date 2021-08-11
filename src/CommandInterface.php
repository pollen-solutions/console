<?php

declare(strict_types=1);

namespace Pollen\Console;

use Symfony\Component\Console\Helper\TableSeparator;

/**
 * @mixin \Symfony\Component\Console\Command\Command
 */
interface CommandInterface
{
    /**
     * INPUT METHODS
     * -----------------------------------------------------------------------------------------------------------------
     */
    /**
     * Get command arguments.
     *
     * @param string|null $key
     *
     * @return string|array|null
     */
    public function getArgument(?string $key = null);

    /**
     * Get command options.
     *
     * @param  string|null  $key
     * @return string|array|bool|null
     */
    public function getOption(?string $key = null);

    /**
     * Check if argument exists.
     *
     * @param string $name
     *
     * @return bool
     */
    public function hasArgument(string $name): bool;

    /**
     * Check if option exists.
     *
     * @param string $name
     *
     * @return bool
     */
    public function hasOption(string $name): bool;

    /**
     * OUTPUT METHODS
     * -----------------------------------------------------------------------------------------------------------------
     */
    /**
     * Asks a question.
     *
     * @param string $question
     * @param string|null $default
     * @param callable|null $validator
     *
     * @return mixed
     */
    public function ask(string $question, ?string $default = null, ?callable $validator = null);

    /**
     * Asks a question with the user input hidden.
     *
     * @param string $question
     * @param callable|null $validator
     *
     * @return mixed
     */
    public function askHidden(string $question, ?callable $validator = null);

    /**
     * Formats a caution admonition.
     *
     * @param string|array $message
     *
     * @return void
     */
    public function caution($message): void;

    /**
     * Asks a choice question.
     *
     * @param string|int|null $default
     *
     * @return mixed
     */
    public function choice(string $question, array $choices, $default = null);

    /**
     * Formats a command comment.
     *
     * @param string|array $message
     *
     * @return void
     */
    public function comment($message): void;

    /**
     * Asks for confirmation.
     *
     * @param string $question
     * @param bool $default
     *
     * @return bool
     */
    public function confirm(string $question, bool $default = true): bool;

    /**
     * Formats a list of key/value horizontally.
     *
     * Each row can be one of:
     * * 'A title'
     * * ['key' => 'value']
     * * new TableSeparator()| $this->definitionListSeparator()
     *
     * @param string|array|\Symfony\Component\Console\Helper\TableSeparator ...$list
     *
     * @return void
     */
    public function definitionList(...$list): void;

    /**
     * A line separation for definition list.
     *
     * @return TableSeparator
     */
    public function definitionListSeparator(): TableSeparator;

    /**
     * Formats an error result bar.
     *
     * @param string|array $message
     *
     * @return void
     */
    public function error($message): void;

    /**
     * Formats a horizontal table.
     *
     * @param string[] $headers
     * @param array<int, string[]> $rows
     *
     * @return void
     */
    public function horizontalTable(array $headers, array $rows): void;

    /**
     * Formats an info message.
     *
     * @param string|array $message
     *
     * @return void
     */
    public function info($message): void;

    /**
     * Formats a list.
     *
     * @param string[] $elements
     *
     * @return void
     */
    public function listing(array $elements): void;

    /**
     * Add newline(s).
     *
     * @param int $count
     *
     * @return void
     */
    public function newLine(int $count = 1): void;

    /**
     * Formats a note admonition.
     *
     * @param string|array $message
     *
     * @return void
     */
    public function note($message): void;

    /**
     * Starts the progress output.
     *
     * @param int $max
     *
     * @return void
     */
    public function progressStart(int $max = 0): void;

    /**
     * Advances the progress output X steps.
     *
     * @param int $step
     *
     * @return void
     */
    public function progressAdvance(int $step = 1): void;

    /**
     * Finishes the progress output.
     *
     * @return void
     */
    public function progressFinish(): void;

    /**
     * Formats a section title.
     *
     * @param string $message
     *
     * @return void
     */
    public function section(string $message): void;

    /**
     * Formats a success result bar.
     *
     * @param string|array $message
     *
     * @return void
     */
    public function success($message): void;

    /**
     * Formats a table.
     *
     * @param string[] $headers
     * @param array<int, string[]> $rows
     *
     * @return void
     */
    public function table(array $headers, array $rows): void;

    /**
     * Formats informational text.
     *
     * @param string|array $message
     *
     * @return void
     */
    public function text($message): void;

    /**
     * Formats a command title.
     *
     * @param string $message
     *
     * @return void
     */
    public function title(string $message): void;

    /**
     * Formats an warning result bar.
     *
     * @param string|array $message
     *
     * @return void
     */
    public function warning($message): void;

    /**
     * COMMAND METHODS
     * -----------------------------------------------------------------------------------------------------------------
     */
}