<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\FactFinderSdk\Persistence;

use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;
use SprykerEco\Zed\FactFinderSdk\FactFinderSdkDependencyProvider;

/**
 * @method \SprykerEco\Zed\FactFinderSdk\FactFinderSdkConfig getConfig()
 * @method \SprykerEco\Zed\FactFinderSdk\Persistence\FactFinderSdkQueryContainer getQueryContainer()
 */
class FactFinderSdkPersistenceFactory extends AbstractPersistenceFactory
{

    /**
     * @return \SprykerEco\Zed\FactFinderSdk\Dependency\Persistence\FactFinderSdkToProductAbstractDataFeedInterface
     */
    public function getProductAbstractDataFeedQueryContainer()
    {
        return $this->getProvidedDependency(FactFinderSdkDependencyProvider::PRODUCT_ABSTRACT_DATA_FEED);
    }

    /**
     * @return \SprykerEco\Zed\FactFinderSdk\Dependency\Persistence\FactFinderSdkToCategoryDataFeedInterface
     */
    public function getCategoryDataFeedQueryContainer()
    {
        return $this->getProvidedDependency(FactFinderSdkDependencyProvider::CATEGORY_DATA_FEED);
    }

}
