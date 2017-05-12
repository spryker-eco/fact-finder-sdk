<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\FactFinderApi\Communication;

use Spryker\Zed\Kernel\Communication\AbstractCommunicationFactory;
use SprykerEco\Zed\FactFinderApi\FactFinderApiDependencyProvider;

/**
 * @method \SprykerEco\Zed\FactFinderApi\Persistence\FactFinderApiQueryContainerInterface getQueryContainer()
 * @method \SprykerEco\Zed\FactFinderApi\FactFinderApiConfig getConfig()
 */
class FactFinderApiCommunicationFactory extends AbstractCommunicationFactory
{

    /**
     * @return \SprykerEco\Zed\FactFinderApi\Dependency\Facade\FactFinderApiToLocaleInterface
     */
    public function getLocaleFacade()
    {
        return $this->getProvidedDependency(FactFinderApiDependencyProvider::LOCALE_FACADE);
    }

}
