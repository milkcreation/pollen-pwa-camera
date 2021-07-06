<?php

declare(strict_types=1);

namespace Pollen\PwaCamera\Partial;

use Pollen\Http\UrlHelper;
use Pollen\Partial\PartialDriver;
use Pollen\Partial\PartialManagerInterface;
use Pollen\PwaCamera\PwaCameraInterface;

class PwaCameraPartial extends PartialDriver
{
    /**
     * Pwa Camera instance.
     * @var PwaCameraInterface
     */
    protected PwaCameraInterface $pwaCamera;

    /**
     * @param PwaCameraInterface $pwaCamera
     * @param PartialManagerInterface $partialManager
     */
    public function __construct(PwaCameraInterface $pwaCamera, PartialManagerInterface $partialManager)
    {
        $this->pwaCamera = $pwaCamera;

        parent::__construct($partialManager);
    }

    /**
     * @inheritDoc
     */
    public function render(): string
    {
        $urlHelper = new UrlHelper();

        $this->set(
            [
                'player' => [
                    'attrs' => [
                        'class'  => 'CameraCapture-player',
                        //'controls',
                        'autoplay',
                        'muted',
                        /*'poster' => $urlHelper->getAbsoluteUrl(
                            $this->pwa()->resources('/assets/src/img/photo-camera.png')
                        ),*/
                    ],
                    'tag'   => 'video',
                ],
            ]
        );

        return parent::render();
    }

    /**
     * @inheritDoc
     */
    public function viewDirectory(): string
    {
        return $this->pwaCamera->resources('/views/partial/camera-capture');
    }
}
