<?php

declare(strict_types=1);

namespace Pollen\Console;

use Symfony\Component\Console\Application as BaseApplication;

class CommandsRunner extends BaseApplication implements CommandsRunnerInterface
{
    /**
     * @param string|null $name
     * @param string|null $version
     */
    public function __construct(?string $name = null, ?string $version = null)
    {
        if ($name === null) {
            $name = 'UNKNOWN';
        }

        if ($version === null) {
            $version = 'UNKNOWN';
        }

        parent::__construct($name, $version);
    }
}