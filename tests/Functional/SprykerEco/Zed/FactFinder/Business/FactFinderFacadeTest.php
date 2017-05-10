<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Functional\SprykerEco\Zed\FactFinder\Business;

use Codeception\Configuration;
use Codeception\TestCase\Test;
use SprykerEco\Zed\FactFinder\Business\FactFinderBusinessFactory;
use SprykerEco\Zed\FactFinder\Business\FactFinderFacade;
use SprykerEco\Zed\FactFinder\FactFinderConfig;
use Spryker\Zed\Locale\Business\LocaleFacade;

/**
 * @group Functional
 * @group SprykerEco
 * @group Zed
 * @group FactFinder
 * @group FactFinderTest
 * @group FactFinderFacadeTest
 */
class FactFinderFacadeTest extends Test
{

    /**
     * @var FactFinderFacade
     */
    protected $factFinderFacade;

    public function setUp()
    {
        parent::setUp();

        $this->factFinderFacade = new FactFinderFacade();
    }

    public function testCreateFactFinderCsv()
    {
        $localeTransfer = $this->getLocaleTransfer('de_DE');

        $this->factFinderFacade->setFactory($this->createFactory());
        $this->factFinderFacade->createFactFinderCsv($localeTransfer);

        $this->assertFileExists(Configuration::outputDir() . 'product_de_DE.csv');
    }

    /**
     * @param $localeName
     *
     * @return \Generated\Shared\Transfer\LocaleTransfer
     */
    protected function getLocaleTransfer($localeName)
    {
        $localeFacade = new LocaleFacade();

        return $localeFacade->getLocale($localeName);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|\SprykerEco\Zed\FactFinder\FactFinderConfig
     */
    protected function createConfigMock()
    {
        $configMock = $this->createMock(FactFinderConfig::class);
        $configMock->method('getCsvDirectory')
            ->willReturn(Configuration::outputDir());
        $configMock->method('getExportFileNamePrefix')
            ->willReturn('product');
        $configMock->method('getExportFileNameDelimiter')
            ->willReturn('_');
        $configMock->method('getExportFileExtension')
            ->willReturn('.csv');
        $configMock->method('getExportQueryLimit')
            ->willReturn(1000);
        $configMock->method('getDetailPageUrl')
            ->willReturn('/fact-finder/');

        return $configMock;
    }

    /**
     * @return \Spryker\Zed\Kernel\Business\AbstractBusinessFactory
     */
    protected function createFactory()
    {
        $factory = new FactFinderBusinessFactory();
        $factory->setConfig($this->createConfigMock());

        return $factory;
    }

}