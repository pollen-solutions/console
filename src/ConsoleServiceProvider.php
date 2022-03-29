<?php

declare(strict_types=1);

namespace Pollen\Console;

use Pollen\Container\BootableServiceProvider;
use Pollen\Event\EventDispatcherInterface;
use Pollen\Kernel\Events\ConfigLoadedEvent;
use Pollen\Kernel\Events\ConfigLoadEvent;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class ConsoleServiceProvider extends BootableServiceProvider
{
    protected $provides = [
        ConsoleInterface::class,
    ];

    /**
     * @inheritDoc
     */
    public function boot(): void
    {
        try {
            /** @var EventDispatcherInterface $event */
            if ($event = $this->getContainer()->get(EventDispatcherInterface::class)) {
                $event->subscribeTo('config.load', static function (ConfigLoadEvent $event) {
                    if (is_callable($config = $event->getConfig('console'))) {
                        $config($event->getApp()->get(ConsoleInterface::class), $event->getApp());
                    }
                });

                $event->subscribeTo('config.loaded', static function (ConfigLoadedEvent $event) {
//                    /** @var ConsoleInterface $console */
//                    if ($console = $event->getApp()->get(ConsoleInterface::class)) {
//                        $console->addFromPath(__DIR__ . DIRECTORY_SEPARATOR . 'Console');
//                    }
                });
            }
        } catch (NotFoundExceptionInterface|ContainerExceptionInterface $e) {
            unset($e);
        }
    }

    /**
     * @inheritDoc
     */
    public function register(): void
    {
        $this->getContainer()->share(ConsoleInterface::class, function () {
            return new Console($this->getContainer());
        });
    }
}