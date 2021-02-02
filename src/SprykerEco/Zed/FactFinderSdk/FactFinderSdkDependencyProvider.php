<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\FactFinderSdk;

use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;
use SprykerEco\Zed\FactFinderSdk\Dependency\Facade\FactFinderSdkToCurrencyBridge;
use SprykerEco\Zed\FactFinderSdk\Dependency\Facade\FactFinderSdkToLocaleBridge;
use SprykerEco\Zed\FactFinderSdk\Dependency\Facade\FactFinderSdkToStoreBridge;
use SprykerEco\Zed\FactFinderSdk\Dependency\Persistence\FactFinderSdkToCategoryDataFeedBridge;
use SprykerEco\Zed\FactFinderSdk\Dependency\Persistence\FactFinderSdkToProductAbstractDataFeedBridge;

class FactFinderSdkDependencyProvider extends AbstractBundleDependencyProvider
{
    public const PRODUCT_ABSTRACT_DATA_FEED = 'PRODUCT_ABSTRACT_DATA_FEED';
    public const CATEGORY_DATA_FEED = 'CATEGORY_DATA_FEED';
    public const LOCALE_FACADE = 'LOCALE_FACADE';
    public const STORE_FACADE = 'STORE_FACADE';
    public const CURRENCY_FACADE = 'CURRENCY_FACADE';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideCommunicationLayerDependencies(Container $container)
    {
        $container = $this->addLocaleFacade($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function providePersistenceLayerDependencies(Container $container)
    {
        $container->set(static::PRODUCT_ABSTRACT_DATA_FEED, function (Container $container) {
            return new FactFinderSdkToProductAbstractDataFeedBridge(
                $container->getLocator()->productAbstractDataFeed()->queryContainer()
            );
        });

        $container->set(static::CATEGORY_DATA_FEED, function (Container $container) {
            return new FactFinderSdkToCategoryDataFeedBridge(
                $container->getLocator()->categoryDataFeed()->queryContainer()
            );
        });

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container)
    {
        $container = $this->addStoreFacade($container);
        $container = $this->addCurrencyFacade($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addStoreFacade(Container $container)
    {
        $container->set(static::STORE_FACADE, function (Container $container) {
            return new FactFinderSdkToStoreBridge($container->getLocator()->store()->facade());
        });

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addCurrencyFacade(Container $container)
    {
        $container->set(static::CURRENCY_FACADE, function (Container $container) {
            return new FactFinderSdkToCurrencyBridge(
                $container->getLocator()->currency()->facade()
            );
        });

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addLocaleFacade(Container $container)
    {
        $container->set(static::LOCALE_FACADE, function (Container $container) {
            return new FactFinderSdkToLocaleBridge(
                $container->getLocator()->locale()->facade()
            );
        });

        return $container;
    }
}
