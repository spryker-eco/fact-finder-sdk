<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Client\FactFinderSdk;

use Spryker\Client\Kernel\AbstractDependencyProvider;
use Spryker\Client\Kernel\Container;

class FactFinderSdkDependencyProvider extends AbstractDependencyProvider
{
    public const SERVICE_ZED = 'SERVICE_ZED';
    public const CLIENT_SESSION = 'CLIENT_SESSION';
    public const CLIENT_KV_STORAGE = 'CLIENT_KV_STORAGE';

    /**
     * @param \Spryker\Client\Kernel\Container $container
     *
     * @return \Spryker\Client\Kernel\Container
     */
    public function provideServiceLayerDependencies(Container $container)
    {
        $container[static::SERVICE_ZED] = function (Container $container) {
            return $container->getLocator()->zedRequest()->client();
        };
        $container[static::CLIENT_SESSION] = function (Container $container) {
            return $container->getLocator()->session()->client();
        };
        $container[static::CLIENT_KV_STORAGE] = function (Container $container) {
            return $container->getLocator()->storage()->client();
        };

        return $container;
    }
}
