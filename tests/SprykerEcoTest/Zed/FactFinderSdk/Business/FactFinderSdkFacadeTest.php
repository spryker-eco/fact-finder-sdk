<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Functional\SprykerEco\Zed\FactFinderSdk\Business;

use Codeception\Configuration;
use Codeception\TestCase\Test;
use Exception;
use Generated\Shared\Transfer\LocaleTransfer;
use Spryker\Zed\Locale\Business\LocaleFacade;
use SprykerEco\Zed\FactFinderSdk\Business\FactFinderSdkBusinessFactory;
use SprykerEco\Zed\FactFinderSdk\Business\FactFinderSdkFacade;
use SprykerEco\Zed\FactFinderSdk\FactFinderSdkConfig;

/**
 * @group Functional
 * @group SprykerEco
 * @group Zed
 * @group FactFinderSdk
 * @group FactFinderSdkTest
 * @group FactFinderSdkFacadeTest
 */
class FactFinderSdkFacadeTest extends Test
{
    /**
     * @var \SprykerEco\Zed\FactFinderSdk\Business\FactFinderSdkFacade
     */
    protected $factFinderFacade;

    /**
     * @var string
     */
    protected $filePathName;

    /**
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->factFinderFacade = new FactFinderSdkFacade();
        $this->filePathName = Configuration::outputDir() . 'product_de_DE_DE_Euro.csv';

        try {
            unlink($this->filePathName);
        } catch (Exception $e) {
        }
    }

    /**
     * @return void
     */
    public function testCreateFactFinderSdkCsvShouldCreateCsvFile(): void
    {
        $localeTransfer = $this->getLocaleTransfer('de_DE');

        $this->factFinderFacade->setFactory($this->createFactory());
        $this->factFinderFacade->createFactFinderSdkCsv($localeTransfer);

        $this->assertFileExists($this->filePathName);
    }

    /**
     * @param string $localeName
     *
     * @return \Generated\Shared\Transfer\LocaleTransfer
     */
    protected function getLocaleTransfer($localeName): LocaleTransfer
    {
        $localeFacade = new LocaleFacade();

        return $localeFacade->getLocale($localeName);
    }

    /**
     * @return \PHPUnit\Framework\MockObject\MockObject|\SprykerEco\Zed\FactFinderSdk\FactFinderSdkConfig
     */
    protected function createConfigMock(): FactFinderSdkConfig
    {
        $configMock = $this->createMock(FactFinderSdkConfig::class);
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
        $configMock->method('getItemFields')
            ->willReturn([
                'ProductNumber',
                'Name',
                'Price',
                'Stock',
                'Category',
                'CategoryPath',
                'ProductURL',
                'ImageURL',
                'Description',
            ]);

        return $configMock;
    }

    /**
     * @return \SprykerEco\Zed\FactFinderSdk\Business\FactFinderSdkBusinessFactory
     */
    protected function createFactory(): FactFinderSdkBusinessFactory
    {
        $factory = new FactFinderSdkBusinessFactory();
        $factory->setConfig($this->createConfigMock());

        return $factory;
    }
}
