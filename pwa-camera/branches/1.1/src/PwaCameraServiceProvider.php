<?php

declare(strict_types=1);

namespace Pollen\PwaCamera;

use Pollen\Partial\PartialManagerInterface;
use Pollen\PwaCamera\Partial\PwaCameraPartial;
use Pollen\Container\ServiceProvider;

class PwaCameraServiceProvider extends ServiceProvider
{
    protected $provides = [
        PwaCameraInterface::class,
        PwaCameraPartial::class
    ];

    /**
     * @inheritDoc
     */
    public function register(): void
    {
        $this->getContainer()->share(
            PwaCameraInterface::class,
            function () {
                return new PwaCamera([], $this->getContainer());
            }
        );

        $this->getContainer()->add(
            PwaCameraPartial::class,
            function () {
                return new PwaCameraPartial(
                    $this->getContainer()->get(PwaCameraInterface::class),
                    $this->getContainer()->get(PartialManagerInterface::class)
                );
            }
        );
    }
}
