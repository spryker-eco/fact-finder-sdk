<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Unit\SprykerEco\Client\FactFinderSdk\Business\Api\Converter;

use ArrayObject;
use FACTFinder\Adapter\ProductCampaign;
use FACTFinder\Data\CampaignIterator;
use Generated\Shared\Transfer\FactFinderSdkDataCampaignIteratorTransfer;
use Generated\Shared\Transfer\FactFinderSdkProductCampaignResponseTransfer;
use PHPUnit_Framework_TestCase;
use SprykerEco\Client\FactFinderSdk\Business\Api\Converter\ConverterFactory;
use SprykerEco\Client\FactFinderSdk\Business\Api\Converter\ProductCampaignResponseConverter;
use SprykerEco\Client\FactFinderSdk\FactFinderSdkConfig;

/**
 * @group Unit
 * @group SprykerEco
 * @group Client
 * @group FactFinderSdk
 * @group FactFinderSdkTest
 * @group SearchResponseConverterTest
 */
class ProductCampaignResponseConverterTest extends PHPUnit_Framework_TestCase
{

    /**
     * @return void
     */
    public function testConvert()
    {
        $converterFactory = $this->createConverterFactory();
        $productCampaignAdapter = $this->createProductCampaignAdapterMock();

        $productCampaignResponseConverter = $this->createProductCampaignResponseConverter($productCampaignAdapter, $converterFactory);

        $expected = $this->createExpectedTransfer()
            ->toArray();
        $result = $productCampaignResponseConverter->convert()
            ->toArray();

        $this->assertEquals($expected, $result);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|\SprykerEco\Client\FactFinderSdk\Business\Api\Converter\ConverterFactory
     */
    protected function createConverterFactory()
    {
        return new ConverterFactory($this->createConfigMock());
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|\SprykerEco\Client\FactFinderSdk\FactFinderSdkConfig
     */
    protected function createConfigMock()
    {
        $configMock = $this->createMock(FactFinderSdkConfig::class);
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
     * @return \PHPUnit_Framework_MockObject_MockObject|\FACTFinder\Adapter\Recommendation
     */
    protected function createProductCampaignAdapterMock()
    {
        $recommendationAdapterMock = $this->getMockBuilder(ProductCampaign::class)
            ->disableOriginalConstructor()
            ->getMock();

        $recommendationAdapterMock->method('getCampaigns')
            ->willReturn($this->getCampaigns());

        return $recommendationAdapterMock;
    }

    /**
     * @return object
     */
    protected function getCampaigns()
    {
        return new CampaignIterator(
            [
            ]
        );
    }

    /**
     * @param \FACTFinder\Adapter\ProductCampaign $productCampaignAdapter
     * @param \SprykerEco\Client\FactFinderSdk\Business\Api\Converter\ConverterFactory $converterFactory
     *
     * @return \SprykerEco\Client\FactFinderSdk\Business\Api\Converter\ProductCampaignResponseConverter
     */
    protected function createProductCampaignResponseConverter(ProductCampaign $productCampaignAdapter, ConverterFactory $converterFactory)
    {
        return new ProductCampaignResponseConverter(
            $productCampaignAdapter,
            $converterFactory->createDataRecordConverter(),
            $converterFactory->createDataAdvisorQuestionConverter()
        );
    }

    /**
     * @return \Generated\Shared\Transfer\FactFinderSdkSearchResponseTransfer
     */
    protected function createExpectedTransfer()
    {
        $searchResponseTransfer = new FactFinderSdkProductCampaignResponseTransfer();

        $searchResponseTransfer->setCampaignIterator($this->getCampaignIteratorTransfer());

        return $searchResponseTransfer;
    }

    /**
     * @return \Generated\Shared\Transfer\FactFinderSdkDataCampaignIteratorTransfer
     */
    protected function getCampaignIteratorTransfer()
    {
        $campaignIterator = new FactFinderSdkDataCampaignIteratorTransfer();
        $campaignIterator->setHasRedirect(false);
        $campaignIterator->setHasFeedback(false);
        $campaignIterator->setHasPushedProducts(false);
        $campaignIterator->setHasActiveQuestions(false);
        $campaignIterator->setHasAdvisorTree(false);
        $campaignIterator->setPushedProducts(new ArrayObject());
        $campaignIterator->setGetActiveQuestions(new ArrayObject());
        $campaignIterator->setGetActiveQuestions(new ArrayObject());
        $campaignIterator->setAdvisorTree(new ArrayObject());
        $campaignIterator->setCampaigns(new ArrayObject());

        return $campaignIterator;
    }

}
