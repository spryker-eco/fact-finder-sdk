<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\FactFinderApi\Persistence;

use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;
use SprykerEco\Zed\FactFinderApi\FactFinderApiDependencyProvider;

/**
 * @method \SprykerEco\Zed\FactFinderApi\FactFinderApiConfig getConfig()
 * @method \SprykerEco\Zed\FactFinderApi\Persistence\FactFinderApiQueryContainer getQueryContainer()
 */
class FactFinderApiPersistenceFactory extends AbstractPersistenceFactory
{

    /**
     * @return \SprykerEco\Zed\FactFinderApi\Dependency\Persistence\FactFinderApiToProductAbstractDataFeedInterface
     */
    public function getProductAbstractDataFeedQueryContainer()
    {
        return $this->getProvidedDependency(FactFinderApiDependencyProvider::PRODUCT_ABSTRACT_DATA_FEED);
    }

    /**
     * @return \SprykerEco\Zed\FactFinderApi\Dependency\Persistence\FactFinderApiToCategoryDataFeedInterface
     */
    public function getCategoryDataFeedQueryContainer()
    {
        return $this->getProvidedDependency(FactFinderApiDependencyProvider::CATEGORY_DATA_FEED);
    }

}
