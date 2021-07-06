<?php

declare(strict_types=1);

namespace Pollen\PwaCamera;

use Pollen\Support\Concerns\BootableTraitInterface;
use Pollen\Support\Concerns\ConfigBagAwareTraitInterface;
use Pollen\Support\Concerns\ResourcesAwareTraitInterface;
use Pollen\Support\Proxy\ContainerProxyInterface;
use Pollen\Support\Proxy\PartialProxyInterface;

interface PwaCameraInterface extends
    BootableTraitInterface,
    ConfigBagAwareTraitInterface,
    ContainerProxyInterface,
    PartialProxyInterface,
    ResourcesAwareTraitInterface
{
    /**
     * Booting.
     *
     * @return void
     */
    public function boot(): void;
}