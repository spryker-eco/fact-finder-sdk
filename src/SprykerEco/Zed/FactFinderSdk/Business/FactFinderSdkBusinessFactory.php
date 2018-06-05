<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\FactFinderSdk\Business;

use Generated\Shared\Transfer\LocaleTransfer;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;
use SprykerEco\Zed\FactFinderSdk\Business\Expander\FactFinderSdkAttributesExpander;
use SprykerEco\Zed\FactFinderSdk\Business\Expander\FactFinderSdkCategoryExpander;
use SprykerEco\Zed\FactFinderSdk\Business\Expander\FactFinderSdkDescriptionExpander;
use SprykerEco\Zed\FactFinderSdk\Business\Expander\FactFinderSdkIsNewExpander;
use SprykerEco\Zed\FactFinderSdk\Business\Expander\FactFinderSdkPriceExpander;
use SprykerEco\Zed\FactFinderSdk\Business\Expander\FactFinderSdkReviewExpander;
use SprykerEco\Zed\FactFinderSdk\Business\Expander\FactFinderSdkTimestampExpander;
use SprykerEco\Zed\FactFinderSdk\Business\Expander\FactFinderSdkUrlExpander;
use SprykerEco\Zed\FactFinderSdk\Business\Exporter\FactFinderSdkProductExporter;
use SprykerEco\Zed\FactFinderSdk\Business\Writer\CsvFileWriter;
use SprykerEco\Zed\FactFinderSdk\Business\Writer\FileWriterInterface;
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
     * @return \SprykerEco\Zed\FactFinderSdk\Dependency\Facade\FactFinderSdkToStoreInterface
     */
    protected function getStoreFacade()
    {
        return $this->getProvidedDependency(FactFinderSdkDependencyProvider::STORE_FACADE);
    }

    /**
     * @return \SprykerEco\Zed\FactFinderSdk\Dependency\Facade\FactFinderSdkToCurrencyInterface
     */
    protected function getCurrencyFacade()
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
    protected function createFactFinderProductExporter(FileWriterInterface $fileWriter, LocaleTransfer $localeTransfer)
    {
        return new FactFinderSdkProductExporter(
            $fileWriter,
            $localeTransfer,
            $this->getConfig(),
            $this->getQueryContainer(),
            $this->getCurrencyFacade(),
            $this->getStoreFacade(),
            $this->getExpanders()
        );
    }

    /**
     * @return \SprykerEco\Zed\FactFinderSdk\Business\Expander\FactFinderSdkExpanderInterface[]
     */
    protected function getExpanders()
    {
        return [
            new FactFinderSdkCategoryExpander($this->getQueryContainer(), $this->getConfig()),
            new FactFinderSdkPriceExpander($this->getQueryContainer(), $this->getConfig()),
            new FactFinderSdkAttributesExpander($this->getQueryContainer(), $this->getConfig()),
            new FactFinderSdkUrlExpander($this->getQueryContainer(), $this->getConfig()),
            new FactFinderSdkDescriptionExpander($this->getQueryContainer(), $this->getConfig()),
            new FactFinderSdkReviewExpander($this->getQueryContainer(), $this->getConfig()),
            new FactFinderSdkTimestampExpander($this->getQueryContainer(), $this->getConfig()),
            new FactFinderSdkIsNewExpander($this->getQueryContainer(), $this->getConfig()),
        ];
    }
}
