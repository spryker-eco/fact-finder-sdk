<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Unit\SprykerEco\Client\FactFinderSdk\Business\Api\Handler\Request;

use FACTFinder\Adapter\Recommendation;
use FACTFinder\Data\Record;
use FACTFinder\Data\Result;
use Generated\Shared\Transfer\FactFinderSdkRecommendationRequestTransfer;
use PHPUnit_Framework_TestCase;
use SprykerEco\Client\FactFinderSdk\Business\Api\Converter\ConverterFactory;
use SprykerEco\Client\FactFinderSdk\Business\Api\FactFinderConnector;
use SprykerEco\Client\FactFinderSdk\Business\Api\Handler\Request\RecommendationRequest;
use SprykerEco\Client\FactFinderSdk\FactFinderSdkConfig;

/**
 * @group Unit
 * @group SprykerEco
 * @group Client
 * @group FactFinderSdk
 * @group FactFinderSdkTest
 * @group RecommendationRequestTest
 */
class RecommendationRequestTest extends PHPUnit_Framework_TestCase
{

    /**
     * @return void
     */
    public function testRequest()
    {
        $recommendationRequest = $this->createRecommendationRequest();
        $factFinderRecommendationRequestTransfer = new FactFinderSdkRecommendationRequestTransfer();
        $factFinderRecommendationRequestTransfer->setId(['test1', 'test2', 'test3']);

        $result = $recommendationRequest->request($factFinderRecommendationRequestTransfer)
            ->toArray();

        $expected = [
            'recommendations' => [
                [
                    'position' => 0,
                    'seoPath' => '',
                    'keywords' => [],
                    'similarity' => 100,
                    'id' => '111_28549472',
                    'fields' => [
                        'ProductNumber' => '60',
                        'Name' => 'Acer Liquid Z630',
                        'Price' => '1879',
                        'Stock' => '1',
                        'Category' => null,
                        'CategoryPath' => '|CategoryPathROOT=Telekommunikation & Navigation|CategoryPathROOT/Telekommunikation & Navigation=Smartphones|',
                        'ProductURL' => 'http://www.de.project.local/de/acer-liquid-z630-101',
                        'ImageURL' => 'http://images.icecat.biz/img/gallery_raw/29406182_3072.png',
                        'Description' => 'test',
                    ],
                ],
            ],
        ];

        $this->assertEquals($expected, $result);
    }

    /**
     * @return \SprykerEco\Client\FactFinderSdk\Business\Api\Handler\Request\RecommendationRequest
     */
    protected function createRecommendationRequest()
    {
        return new RecommendationRequest(
            $this->createFactFinderConnectorMock(),
            new ConverterFactory($this->createConfigMock())
        );
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
     * @return \PHPUnit_Framework_MockObject_MockObject|\SprykerEco\Client\FactFinderSdk\Business\Api\FactFinderConnector
     */
    protected function createFactFinderConnectorMock()
    {
        $connector = $this->getMockBuilder(FactFinderConnector::class)
            ->disableOriginalConstructor()
            ->getMock();
        $connector->method('createRecommendationAdapter')
            ->willReturn($this->createRecommendationAdapterMock());

        return $connector;
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|\FACTFinder\Adapter\Suggest
     */
    protected function createRecommendationAdapterMock()
    {
        $suggestAdapterMock = $this->getMockBuilder(Recommendation::class)
            ->disableOriginalConstructor()
            ->getMock();

        $suggestAdapterMock->method('getRecommendations')
            ->willReturn($this->getRecommendations());

        return $suggestAdapterMock;
    }

    /**
     * @return \FACTFinder\Data\Result
     */
    protected function getRecommendations()
    {
        return new Result([
            new Record(
                '111_28549472',
                [
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
                ]
            )
        ], 1);
    }

}
