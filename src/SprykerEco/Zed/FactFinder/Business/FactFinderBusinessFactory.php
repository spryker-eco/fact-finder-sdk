<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\FactFinder\Business;

use Generated\Shared\Transfer\LocaleTransfer;
use SprykerEco\Zed\FactFinder\Business\Exporter\FactFinderProductExporter;
use SprykerEco\Zed\FactFinder\Business\Writer\AbstractFileWriter;
use SprykerEco\Zed\FactFinder\Business\Writer\CsvFileWriter;
use SprykerEco\Zed\FactFinder\FactFinderDependencyProvider;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \SprykerEco\Zed\FactFinder\Persistence\FactFinderQueryContainerInterface getQueryContainer()
 * @method \SprykerEco\Zed\FactFinder\FactFinderConfig getConfig()
 */
class FactFinderBusinessFactory extends AbstractBusinessFactory
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
     * @return \SprykerEco\Zed\FactFinder\FactFinderConfig
     */
    public function getFactFinderConfig()
    {
        return $this->getConfig();
    }

    /**
     * @return \SprykerEco\Zed\FactFinder\Persistence\FactFinderQueryContainerInterface
     */
    public function getFactFinderQueryContainer()
    {
        return $this->getQueryContainer();
    }

    /**
     * @return \SprykerEco\Zed\FactFinder\Dependency\Facade\FactFinderToLocaleInterface
     */
    public function getLocaleFacade()
    {
        return $this->getProvidedDependency(FactFinderDependencyProvider::LOCALE_FACADE);
    }

    /**
     * @param \SprykerEco\Zed\FactFinder\Business\Writer\AbstractFileWriter $fileWriter
     * @param \Generated\Shared\Transfer\LocaleTransfer $localeTransfer
     *
     * @return \SprykerEco\Zed\FactFinder\Business\Exporter\FactFinderProductExporter
     */
    protected function createFactFinderProductExporter(AbstractFileWriter $fileWriter, LocaleTransfer $localeTransfer)
    {
        return new FactFinderProductExporter(
            $fileWriter,
            $localeTransfer,
            $this->getConfig(),
            $this->getQueryContainer()
        );
    }

}
