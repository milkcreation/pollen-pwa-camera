<?php

declare(strict_types=1);

namespace Pollen\PwaCamera;

use Pollen\PwaCamera\Partial\PwaCameraPartial;
use Pollen\Support\Concerns\BootableTrait;
use Pollen\Support\Concerns\ConfigBagAwareTrait;
use Pollen\Support\Concerns\ResourcesAwareTrait;
use Pollen\Support\Exception\ManagerRuntimeException;
use Pollen\Support\Proxy\ContainerProxy;
use Pollen\Support\Proxy\PartialProxy;
use Psr\Container\ContainerInterface as Container;

class PwaCamera implements PwaCameraInterface
{
    use BootableTrait;
    use ConfigBagAwareTrait;
    use ContainerProxy;
    use PartialProxy;
    use ResourcesAwareTrait;

    /**
     * Main instance.
     * @var static|null
     */
    private static ?PwaCameraInterface $instance = null;

    /**
     * @param array $config
     * @param Container|null $container
     *
     * @return void
     */
    public function __construct(array $config = [], ?Container $container = null)
    {
        $this->setConfig($config);

        if ($container !== null) {
            $this->setContainer($container);
        }

        $this->setResourcesBaseDir(dirname(__DIR__) . '/resources');

        if (!self::$instance instanceof static) {
            self::$instance = $this;
        }

        $this->boot();
    }

    /**
     * Get main instance.
     *
     * @return static
     */
    public static function getInstance(): PwaCameraInterface
    {
        if (self::$instance instanceof self) {
            return self::$instance;
        }
        throw new ManagerRuntimeException(sprintf('Unavailable [%s] instance', __CLASS__));
    }

    /**
     * @inheritDoc
     */
    public function boot(): void
    {
        if (!$this->isBooted()) {
            $this->partial()
                ->register(
                    'pwa-camera',
                    $this->containerHas(PwaCameraPartial::class)
                        ? PwaCameraPartial::class : new PwaCameraPartial($this, $this->partial())
                );

            $this->setBooted();
        }
    }
}