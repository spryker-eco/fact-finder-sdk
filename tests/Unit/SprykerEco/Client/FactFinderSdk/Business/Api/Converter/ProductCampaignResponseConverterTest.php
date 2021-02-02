<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Unit\SprykerEco\Client\FactFinderSdk\Business\Api\Converter;

use ArrayObject;
use FACTFinder\Adapter\ProductCampaign;
use FACTFinder\Adapter\Recommendation;
use FACTFinder\Data\Campaign;
use FACTFinder\Data\CampaignIterator;
use FACTFinder\Data\Record;
use Generated\Shared\Transfer\FactFinderSdkDataCampaignIteratorTransfer;
use Generated\Shared\Transfer\FactFinderSdkDataCampaignTransfer;
use Generated\Shared\Transfer\FactFinderSdkDataRecordTransfer;
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
     * @return \PHPUnit\Framework\MockObject\MockObject|\SprykerEco\Client\FactFinderSdk\Business\Api\Converter\ConverterFactory
     */
    protected function createConverterFactory(): ConverterFactory
    {
        return new ConverterFactory($this->createConfigMock());
    }

    /**
     * @return \PHPUnit\Framework\MockObject\MockObject|\SprykerEco\Client\FactFinderSdk\FactFinderSdkConfig
     */
    protected function createConfigMock(): FactFinderSdkConfig
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
     * @return \PHPUnit\Framework\MockObject\MockObject|\FACTFinder\Adapter\Recommendation
     */
    protected function createProductCampaignAdapterMock(): Recommendation
    {
        $recommendationAdapterMock = $this->getMockBuilder(ProductCampaign::class)
            ->disableOriginalConstructor()
            ->getMock();

        $recommendationAdapterMock->method('getCampaigns')
            ->willReturn($this->getCampaigns());

        return $recommendationAdapterMock;
    }

    /**
     * @return \FACTFinder\Data\CampaignIterator
     */
    protected function getCampaigns()
    {
        $pushedProducts = [
            new Record(
                '111_28549472',
                [
                    '__ORIG_POSITION__' => '1',
                    'Category' => '..Tablets..',
                    'Description' => 'Zum Lernen konzipiert Profitieren Sie von sofortiger Einsatzfähigkeit mit den neuen HP School Pack Tools und Inhalten zur Unterstützung neuer Lernmethoden, darunter HP Classroom Manager, mit dem Lehrer das Klassenzimmer steuern, Klassen-PCs verwalten und mit Schülern kommunizieren können. Erzielen Sie ein 1:1-Lernerlebnis und steigern Sie das Engagement der Schüler mit diesem Android?-Tablet, das speziell für Schulen entwickelt wurde. Das zuverlässige und robuste HP Pro Tablet 10 EE umfasst Lerntools und flexible Konnektivitätsoptionen für ein Lernerlebnis über das Klassenzimmer hinweg. Darüber hinaus unterstützen professionelle Support- und Serviceleistungen das Lehrpersonal bei der Einbindung neuer IT-Komponenten.',
                    'FFAutomaticSearchOptimization' => '',
                    'DQAttributes' => '',
                    'ImageURL' => 'http://images.icecat.biz/img/gallery/28516206_9380.jpg',
                    'ProductNumber' => '111_28549472',
                    'ProductURL' => '/fact-finder/detail/111_28549472',
                    'FFCheckoutCount' => '0',
                    'Name' => 'HP Pro Tablet 608 G1',
                    'FFAfterSearchReorder' => '',
                    'CategoryPath' => '|CategoryPathROOT=Computer|CategoryPathROOT/Computer=Tablets|',
                    'Price' => '28178',
                    'Stock' => '0',
                ],
                99.980000000000004,
                1
            ),
        ];

        return new CampaignIterator(
            [
                new Campaign(
                    'test campaign',
                    'test category',
                    'https://google.de/',
                    $pushedProducts,
                    [],
                    [],
                    []
                ),
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

        foreach ($this->getCampaigns() as $campaign) {
            $factFinderDataCampaignTransfer = new FactFinderSdkDataCampaignTransfer();
            $factFinderDataCampaignTransfer->setName($campaign->getName());
            $factFinderDataCampaignTransfer->setCategory($campaign->getCategory());
            $factFinderDataCampaignTransfer->setRedirectUrl($campaign->getRedirectUrl());
            $factFinderDataCampaignTransfer->setFeedback($campaign->getFeedbackArray());
            $factFinderDataCampaignTransfer->setHasRedirect($campaign->hasRedirect());
            $factFinderDataCampaignTransfer->setHasPushedProducts($campaign->hasPushedProducts());
            $campaignIterator->addCampaigns($factFinderDataCampaignTransfer);

            foreach ($campaign->getPushedProducts() as $pushedProduct) {
                $factFinderDataRecordTransfer = new FactFinderSdkDataRecordTransfer();
                $factFinderDataRecordTransfer->setId($pushedProduct->getID());
                $factFinderDataRecordTransfer->setSimilarity($pushedProduct->getSimilarity());
                $factFinderDataRecordTransfer->setPosition($pushedProduct->getPosition());
                $factFinderDataRecordTransfer->setOriginalPosition($pushedProduct->getPosition());
                $factFinderDataRecordTransfer->setSeoPath($pushedProduct->getSeoPath());
                $factFinderDataRecordTransfer->setKeywords($pushedProduct->getKeywords());

                $fields = [];
                foreach ($this->createConfigMock()->getItemFields() as $itemFieldName) {
                    $fields[$itemFieldName] = $pushedProduct->getField($itemFieldName);
                }
                $factFinderDataRecordTransfer->setFields($fields);

                $campaignIterator->addPushedProducts($factFinderDataRecordTransfer);
                $factFinderDataCampaignTransfer->addPushedProducts($factFinderDataRecordTransfer);
            }
        }

        $campaignIterator->setHasRedirect(true);
        $campaignIterator->setRedirectUrl('https://google.de/');
        $campaignIterator->setHasFeedback(false);
        $campaignIterator->setHasPushedProducts(true);
        $campaignIterator->setHasActiveQuestions(false);
        $campaignIterator->setHasAdvisorTree(false);
        $campaignIterator->setGetActiveQuestions(new ArrayObject());
        $campaignIterator->setGetActiveQuestions(new ArrayObject());
        $campaignIterator->setAdvisorTree(new ArrayObject());

        return $campaignIterator;
    }
}
