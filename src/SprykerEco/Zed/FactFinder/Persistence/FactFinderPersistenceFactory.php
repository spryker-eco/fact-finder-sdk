<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\FactFinder\Persistence;

use SprykerEco\Zed\FactFinder\FactFinderDependencyProvider;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

/**
 * @method \SprykerEco\Zed\FactFinder\FactFinderConfig getConfig()
 * @method \SprykerEco\Zed\FactFinder\Persistence\FactFinderQueryContainer getQueryContainer()
 */
class FactFinderPersistenceFactory extends AbstractPersistenceFactory
{

    /**
     * @return \SprykerEco\Zed\FactFinder\Dependency\Persistence\FactFinderToProductAbstractDataFeedInterface
     */
    public function getProductAbstractDataFeedQueryContainer()
    {
        return $this->getProvidedDependency(FactFinderDependencyProvider::PRODUCT_ABSTRACT_DATA_FEED);
    }

    /**
     * @return \SprykerEco\Zed\FactFinder\Dependency\Persistence\FactFinderToCategoryDataFeedInterface
     */
    public function getCategoryDataFeedQueryContainer()
    {
        return $this->getProvidedDependency(FactFinderDependencyProvider::CATEGORY_DATA_FEED);
    }

}
