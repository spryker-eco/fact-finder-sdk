<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Functional\SprykerEco\Zed\FactFinderApi\Business;

use Codeception\Configuration;
use Codeception\TestCase\Test;
use Spryker\Zed\Locale\Business\LocaleFacade;
use SprykerEco\Zed\FactFinderApi\Business\FactFinderApiBusinessFactory;
use SprykerEco\Zed\FactFinderApi\Business\FactFinderApiFacade;
use SprykerEco\Zed\FactFinderApi\FactFinderApiConfig;

/**
 * @group Functional
 * @group SprykerEco
 * @group Zed
 * @group FactFinderApi
 * @group FactFinderApiTest
 * @group FactFinderApiFacadeTest
 */
class FactFinderApiFacadeTest extends Test
{

    /**
     * @var \SprykerEco\Zed\FactFinderApi\Business\FactFinderApiFacade
     */
    protected $factFinderFacade;

    /**
     * @var string
     */
    protected $filePathName;

    /**
     * @return void
     */
    public function setUp()
    {
        parent::setUp();

        $this->factFinderFacade = new FactFinderApiFacade();
        $this->filePathName = Configuration::outputDir() . 'product_de_DE.csv';

        @unlink($this->filePathName);
    }

    /**
     * @return void
     */
    public function testCreateFactFinderApiCsv()
    {
        $localeTransfer = $this->getLocaleTransfer('de_DE');

        $this->factFinderFacade->setFactory($this->createFactory());
        $this->factFinderFacade->createFactFinderApiCsv($localeTransfer);

        $this->assertFileExists($this->filePathName);
    }

    /**
     * @param string $localeName
     *
     * @return \Generated\Shared\Transfer\LocaleTransfer
     */
    protected function getLocaleTransfer($localeName)
    {
        $localeFacade = new LocaleFacade();

        return $localeFacade->getLocale($localeName);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|\SprykerEco\Zed\FactFinderApi\FactFinderApiConfig
     */
    protected function createConfigMock()
    {
        $configMock = $this->createMock(FactFinderApiConfig::class);
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

        return $configMock;
    }

    /**
     * @return \Spryker\Zed\Kernel\Business\AbstractBusinessFactory
     */
    protected function createFactory()
    {
        $factory = new FactFinderApiBusinessFactory();
        $factory->setConfig($this->createConfigMock());

        return $factory;
    }

}
