<?php

declare(strict_types=1);

namespace Pollen\Console;

use Symfony\Component\Console\Input\ArrayInput;

class CommandArrayInput extends ArrayInput implements CommandInputInterface
{
}