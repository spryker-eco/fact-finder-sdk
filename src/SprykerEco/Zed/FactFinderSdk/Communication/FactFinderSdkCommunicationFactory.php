<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\FactFinderSdk\Communication;

use Spryker\Zed\Kernel\Communication\AbstractCommunicationFactory;
use SprykerEco\Zed\FactFinderSdk\FactFinderSdkDependencyProvider;

/**
 * @method \SprykerEco\Zed\FactFinderSdk\Persistence\FactFinderSdkQueryContainerInterface getQueryContainer()
 * @method \SprykerEco\Zed\FactFinderSdk\FactFinderSdkConfig getConfig()
 */
class FactFinderSdkCommunicationFactory extends AbstractCommunicationFactory
{

    /**
     * @return \SprykerEco\Zed\FactFinderSdk\Dependency\Facade\FactFinderSdkToLocaleInterface
     */
    public function getLocaleFacade()
    {
        return $this->getProvidedDependency(FactFinderSdkDependencyProvider::LOCALE_FACADE);
    }

}
