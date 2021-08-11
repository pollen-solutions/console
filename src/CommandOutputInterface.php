<?php

declare(strict_types=1);

namespace Pollen\Console;

use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\StyleInterface;

interface CommandOutputInterface extends OutputInterface, StyleInterface
{
    /**
     * Formats a command comment.
     *
     * @param string|array $message
     */
    public function comment($message);

    /**
     * Formats a list of key/value horizontally.
     *
     * Each row can be one of:
     * * 'A title'
     * * ['key' => 'value']
     * * new TableSeparator()
     *
     * @param string|array|\Symfony\Component\Console\Helper\TableSeparator ...$list
     */
    public function definitionList(...$list);

    /**
     * Formats a horizontal table.
     *
     * @param string[] $headers
     * @param array $rows
     */
    public function horizontalTable(array $headers, array $rows);

    /**
     * Formats an info message.
     *
     * @param string|array $message
     */
    public function info($message);
}