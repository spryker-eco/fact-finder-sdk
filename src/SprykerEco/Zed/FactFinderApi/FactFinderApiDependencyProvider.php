<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\FactFinderApi;

use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;
use SprykerEco\Zed\FactFinderApi\Dependency\Facade\FactFinderApiToLocaleBridge;
use SprykerEco\Zed\FactFinderApi\Dependency\Facade\FactFinderApiToMoneyBridge;
use SprykerEco\Zed\FactFinderApi\Dependency\Persistence\FactFinderApiToCategoryDataFeedBridge;
use SprykerEco\Zed\FactFinderApi\Dependency\Persistence\FactFinderApiToProductAbstractDataFeedBridge;

class FactFinderApiDependencyProvider extends AbstractBundleDependencyProvider
{

    const PRODUCT_ABSTRACT_DATA_FEED = 'PRODUCT_ABSTRACT_DATA_FEED';
    const CATEGORY_DATA_FEED = 'CATEGORY_DATA_FEED';
    const LOCALE_FACADE = 'LOCALE_FACADE';
    const MONEY_FACADE = 'MONEY_FACADE';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideCommunicationLayerDependencies(Container $container)
    {
        $container[self::LOCALE_FACADE] = function (Container $container) {
            $localeFacade = $container->getLocator()
                ->locale()
                ->facade();

            return new FactFinderApiToLocaleBridge($localeFacade);
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function providePersistenceLayerDependencies(Container $container)
    {
        $container[self::PRODUCT_ABSTRACT_DATA_FEED] = function (Container $container) {
            $productAbstractDataFeedQueryContainer = $container->getLocator()
                ->productAbstractDataFeed()
                ->queryContainer();

            return new FactFinderApiToProductAbstractDataFeedBridge($productAbstractDataFeedQueryContainer);
        };

        $container[self::CATEGORY_DATA_FEED] = function (Container $container) {
            $categoryDataFeedQueryContainer = $container->getLocator()
                ->categoryDataFeed()
                ->queryContainer();

            return new FactFinderApiToCategoryDataFeedBridge($categoryDataFeedQueryContainer);
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
        $container[self::MONEY_FACADE] = function (Container $container) {
            $moneyFacade = $container->getLocator()
                ->money()
                ->facade();

            return new FactFinderApiToMoneyBridge($moneyFacade);
        };

        return $container;
    }

}
