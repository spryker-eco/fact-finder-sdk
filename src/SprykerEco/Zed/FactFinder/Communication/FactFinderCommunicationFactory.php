<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\FactFinder\Communication;

use SprykerEco\Zed\FactFinder\FactFinderDependencyProvider;
use Spryker\Zed\Kernel\Communication\AbstractCommunicationFactory;

/**
 * @method \SprykerEco\Zed\FactFinder\Persistence\FactFinderQueryContainerInterface getQueryContainer()
 * @method \SprykerEco\Zed\FactFinder\FactFinderConfig getConfig()
 */
class FactFinderCommunicationFactory extends AbstractCommunicationFactory
{

    /**
     * @return \SprykerEco\Zed\FactFinder\Dependency\Facade\FactFinderToLocaleInterface
     */
    public function getLocaleFacade()
    {
        return $this->getProvidedDependency(FactFinderDependencyProvider::LOCALE_FACADE);
    }

}
