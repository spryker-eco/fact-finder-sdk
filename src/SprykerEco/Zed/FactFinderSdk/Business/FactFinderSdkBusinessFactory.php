<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\FactFinderSdk\Business;

use Generated\Shared\Transfer\LocaleTransfer;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;
use SprykerEco\Zed\FactFinderSdk\Business\Exporter\FactFinderSdkProductExporter;
use SprykerEco\Zed\FactFinderSdk\Business\Writer\AbstractFileWriter;
use SprykerEco\Zed\FactFinderSdk\Business\Writer\CsvFileWriter;
use SprykerEco\Zed\FactFinderSdk\FactFinderSdkDependencyProvider;

/**
 * @method \SprykerEco\Zed\FactFinderSdk\Persistence\FactFinderSdkQueryContainerInterface getQueryContainer()
 * @method \SprykerEco\Zed\FactFinderSdk\FactFinderSdkConfig getConfig()
 */
class FactFinderSdkBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @SuppressWarnings(FactoryMethodReturnInterfaceRule)
     *
     * @param \Generated\Shared\Transfer\LocaleTransfer $localeTransfer
     *
     * @return void
     */
    public function createCsvFile(LocaleTransfer $localeTransfer)
    {
        $this->createFactFinderProductExporter($this->createCsvFileWriter(), $localeTransfer)->export();
    }

    /**
     * @return \SprykerEco\Zed\FactFinderSdk\FactFinderSdkConfigInterface
     */
    public function getFactFinderConfig()
    {
        return $this->getConfig();
    }

    /**
     * @return \SprykerEco\Zed\FactFinderSdk\Persistence\FactFinderSdkQueryContainerInterface
     */
    public function getFactFinderQueryContainer()
    {
        return $this->getQueryContainer();
    }

    /**
     * @return \SprykerEco\Zed\FactFinderSdk\Dependency\Facade\FactFinderSdkToLocaleInterface
     */
    public function getLocaleFacade()
    {
        return $this->getProvidedDependency(FactFinderSdkDependencyProvider::LOCALE_FACADE);
    }

    /**
     * @return \SprykerEco\Zed\FactFinderSdk\Dependency\Facade\FactFinderSdkToMoneyInterface
     */
    public function getMoneyFacade()
    {
        return $this->getProvidedDependency(FactFinderSdkDependencyProvider::MONEY_FACADE);
    }

    /**
     * @return \SprykerEco\Zed\FactFinderSdk\Dependency\Facade\FactFinderSdkToStoreInterface
     */
    public function getStoreFacade()
    {
        return $this->getProvidedDependency(FactFinderSdkDependencyProvider::STORE_FACADE);
    }

    /**
     * @return \SprykerEco\Zed\FactFinderSdk\Dependency\Facade\FactFinderSdkToCurrencyInterface
     */
    public function getCurrencyFacade()
    {
        return $this->getProvidedDependency(FactFinderSdkDependencyProvider::CURRENCY_FACADE);
    }

    /**
     * @return \SprykerEco\Zed\FactFinderSdk\Business\Writer\FileWriterInterface
     */
    protected function createCsvFileWriter()
    {
        return new CsvFileWriter();
    }

    /**
     * @param \SprykerEco\Zed\FactFinderSdk\Business\Writer\AbstractFileWriter $fileWriter
     * @param \Generated\Shared\Transfer\LocaleTransfer $localeTransfer
     *
     * @return \SprykerEco\Zed\FactFinderSdk\Business\Exporter\FactFinderSdkProductExporterInterface
     */
    protected function createFactFinderProductExporter(AbstractFileWriter $fileWriter, LocaleTransfer $localeTransfer)
    {
        return new FactFinderSdkProductExporter(
            $fileWriter,
            $localeTransfer,
            $this->getConfig(),
            $this->getQueryContainer(),
            $this->getCurrencyFacade(),
            $this->getStoreFacade()
        );
    }
}
