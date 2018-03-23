<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Unit\SprykerEco\Client\FactFinderSdk\Business\Api\Converter;

use FACTFinder\Adapter\Recommendation;
use FACTFinder\Loader;
use Generated\Shared\Transfer\FactFinderSdkRecommendationResponseTransfer;
use PHPUnit_Framework_TestCase;
use SprykerEco\Client\FactFinderSdk\Business\Api\Converter\RecommendationResponseConverter;
use SprykerEco\Client\FactFinderSdk\FactFinderSdkConfig;

/**
 * @group Unit
 * @group SprykerEco
 * @group Client
 * @group FactFinderSdk
 * @group FactFinderSdkTest
 * @group RecommendationResponseConverterTest
 */
class RecommendationResponseConverterTest extends PHPUnit_Framework_TestCase
{
    /**
     * @return void
     */
    public function testConvert()
    {
        $recommendationResponseConverter = new RecommendationResponseConverter($this->createRecommendationAdapterMock(), $this->createConfigMock());
        $resultFactFinderSdkRecommendationResponseTransfer = $recommendationResponseConverter->convert();

        $expectedRecommendation = $this->getExpectedTransferObject()
            ->getRecommendations();
        $resultRecommendations = $resultFactFinderSdkRecommendationResponseTransfer->getRecommendations();

        $this->assertEquals($expectedRecommendation, $resultRecommendations);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|\FACTFinder\Adapter\Recommendation
     */
    protected function createRecommendationAdapterMock()
    {
        $recommendationAdapterMock = $this->getMockBuilder(Recommendation::class)
            ->disableOriginalConstructor()
            ->getMock();

        $recommendationAdapterMock->method('getRecommendations')
            ->willReturn($this->getRecommendations());

        return $recommendationAdapterMock;
    }

    /**
     * @return object
     */
    protected function getRecommendations()
    {
        $recordData = [
            "Description" => "test",
            "MasterProductNumber" => "101",
            "FFAutomaticSearchOptimization" => "",
            "DQAttributes" => "",
            "ImageURL" => "http://images.icecat.biz/img/gallery_raw/29406182_3072.png",
            "ProductNumber" => "60",
            "ProductURL" => "http://www.de.project.local/de/acer-liquid-z630-101",
            "FFCheckoutCount" => "0",
            "Name" => "Acer Liquid Z630",
            "FFAfterSearchReorder" => "",
            "Category4" => "",
            "CategoryPath" => "|CategoryPathROOT=Telekommunikation & Navigation|CategoryPathROOT/Telekommunikation & Navigation=Smartphones|",
            "Category3" => "",
            "Category2" => "..Smartphones..",
            "Category1" => "..Telekommunikation & Navigation..",
            "Price" => "1879",
            "brand" => "..Acer..",
            "Stock" => "1",
        ];
        $records = [
            Loader::getInstance(
                'Data\Record',
                '1',
                $recordData,
                100.0,
                1
            ),
        ];
        $result = Loader::getInstance(
            'Data\Result',
            $records,
            null,
            count($records)
        );

        return $result;
    }

    /**
     * @return \Generated\Shared\Transfer\FactFinderSdkRecommendationResponseTransfer
     */
    protected function getExpectedTransferObject()
    {
        $factFinderSuggestResponseTransfer = new FactFinderSdkRecommendationResponseTransfer();
        $factFinderSuggestResponseTransfer->setRecommendations([
            [
                'position' => 1,
                'seoPath' => '',
                'keywords' => [],
                'similarity' => 100,
                'id' => '1',
                'fields' => [
                    'ProductNumber' => '60',
                    'Name' => 'Acer Liquid Z630',
                    'Price' => '1879',
                    'Stock' => '1',
                    'Category' => '',
                    'CategoryPath' => '|CategoryPathROOT=Telekommunikation & Navigation|CategoryPathROOT/Telekommunikation & Navigation=Smartphones|',
                    'ProductURL' => 'http://www.de.project.local/de/acer-liquid-z630-101',
                    'ImageURL' => 'http://images.icecat.biz/img/gallery_raw/29406182_3072.png',
                    'Description' => 'test',
                ],
            ],
        ]);

        return $factFinderSuggestResponseTransfer;
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|\SprykerEco\Client\FactFinderSdk\FactFinderSdkConfig
     */
    protected function createConfigMock()
    {
        $configMock = $this->getMockBuilder(FactFinderSdkConfig::class)
            ->disableOriginalConstructor()
            ->getMock();
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
}
