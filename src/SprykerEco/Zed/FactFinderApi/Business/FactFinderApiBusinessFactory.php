<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\FactFinderApi\Business;

use Generated\Shared\Transfer\LocaleTransfer;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;
use SprykerEco\Zed\FactFinderApi\Business\Exporter\FactFinderApiProductExporter;
use SprykerEco\Zed\FactFinderApi\Business\Writer\AbstractFileWriter;
use SprykerEco\Zed\FactFinderApi\Business\Writer\CsvFileWriter;
use SprykerEco\Zed\FactFinderApi\FactFinderApiDependencyProvider;

/**
 * @method \SprykerEco\Zed\FactFinderApi\Persistence\FactFinderApiQueryContainerInterface getQueryContainer()
 * @method \SprykerEco\Zed\FactFinderApi\FactFinderApiConfig getConfig()
 */
class FactFinderApiBusinessFactory extends AbstractBusinessFactory
{

    /**
     * @param \Generated\Shared\Transfer\LocaleTransfer $localeTransfer
     *
     * @return void
     */
    public function createCsvFile(LocaleTransfer $localeTransfer)
    {
        return $this->createFactFinderProductExporter(new CsvFileWriter(), $localeTransfer)
            ->export();
    }

    /**
     * @return \SprykerEco\Zed\FactFinderApi\FactFinderApiConfig
     */
    public function getFactFinderConfig()
    {
        return $this->getConfig();
    }

    /**
     * @return \SprykerEco\Zed\FactFinderApi\Persistence\FactFinderApiQueryContainerInterface
     */
    public function getFactFinderQueryContainer()
    {
        return $this->getQueryContainer();
    }

    /**
     * @return \SprykerEco\Zed\FactFinderApi\Dependency\Facade\FactFinderApiToLocaleInterface
     */
    public function getLocaleFacade()
    {
        return $this->getProvidedDependency(FactFinderApiDependencyProvider::LOCALE_FACADE);
    }

    /**
     * @return \SprykerEco\Zed\FactFinderApi\Dependency\Facade\FactFinderApiToMoneyInterface
     */
    public function getMoneyFacade()
    {
        return $this->getProvidedDependency(FactFinderApiDependencyProvider::MONEY_FACADE);
    }

    /**
     * @param \SprykerEco\Zed\FactFinderApi\Business\Writer\AbstractFileWriter $fileWriter
     * @param \Generated\Shared\Transfer\LocaleTransfer $localeTransfer
     *
     * @return \SprykerEco\Zed\FactFinderApi\Business\Exporter\FactFinderApiProductExporter
     */
    protected function createFactFinderProductExporter(AbstractFileWriter $fileWriter, LocaleTransfer $localeTransfer)
    {
        return new FactFinderApiProductExporter(
            $fileWriter,
            $localeTransfer,
            $this->getConfig(),
            $this->getQueryContainer(),
            $this->getMoneyFacade()
        );
    }

}
