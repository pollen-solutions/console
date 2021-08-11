<?php

declare(strict_types=1);

namespace Pollen\Console;

use Symfony\Component\Console\Command\LockableTrait;

class LockableCommand extends Command
{
    use LockableTrait;
}