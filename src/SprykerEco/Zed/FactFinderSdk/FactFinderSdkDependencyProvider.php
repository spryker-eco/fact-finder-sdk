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
        $container[static::PRODUCT_ABSTRACT_DATA_FEED] = function (Container $container) {
            $productAbstractDataFeedQueryContainer = $container->getLocator()
                ->productAbstractDataFeed()
                ->queryContainer();

            return new FactFinderSdkToProductAbstractDataFeedBridge($productAbstractDataFeedQueryContainer);
        };

        $container[static::CATEGORY_DATA_FEED] = function (Container $container) {
            $categoryDataFeedQueryContainer = $container->getLocator()
                ->categoryDataFeed()
                ->queryContainer();

            return new FactFinderSdkToCategoryDataFeedBridge($categoryDataFeedQueryContainer);
        };

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
        $container[static::STORE_FACADE] = function (Container $container) {
            $storeFacade = $container->getLocator()
                ->store()
                ->facade();

            return new FactFinderSdkToStoreBridge($storeFacade);
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addCurrencyFacade(Container $container)
    {
        $container[static::CURRENCY_FACADE] = function (Container $container) {
            $currencyFacade = $container->getLocator()
                ->currency()
                ->facade();

            return new FactFinderSdkToCurrencyBridge($currencyFacade);
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addLocaleFacade(Container $container)
    {
        $container[static::LOCALE_FACADE] = function (Container $container) {
            $localeFacade = $container->getLocator()
                ->locale()
                ->facade();

            return new FactFinderSdkToLocaleBridge($localeFacade);
        };

        return $container;
    }
}
