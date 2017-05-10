<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Unit\SprykerEco\Client\FactFinder\Business\Api\Converter;

use ArrayObject;
use FACTFinder\Adapter\Search;
use FACTFinder\Data\Record;
use FACTFinder\Data\Result;
use Generated\Shared\Transfer\FactFinderDataAfterSearchNavigationTransfer;
use Generated\Shared\Transfer\FactFinderDataBreadCrumbTransfer;
use Generated\Shared\Transfer\FactFinderDataCampaignIteratorTransfer;
use Generated\Shared\Transfer\FactFinderDataItemTransfer;
use Generated\Shared\Transfer\FactFinderDataPageTransfer;
use Generated\Shared\Transfer\FactFinderDataPagingTransfer;
use Generated\Shared\Transfer\FactFinderDataRecordTransfer;
use Generated\Shared\Transfer\FactFinderDataResultsPerPageOptionsTransfer;
use Generated\Shared\Transfer\FactFinderDataResultTransfer;
use Generated\Shared\Transfer\FactFinderSearchResponseTransfer;
use PHPUnit_Framework_TestCase;
use SprykerEco\Client\FactFinder\Business\Api\Converter\ConverterFactory;
use SprykerEco\Client\FactFinder\Business\Api\Converter\SearchResponseConverter;

/**
 * @group Unit
 * @group SprykerEco
 * @group Client
 * @group FactFinder
 * @group FactFinderTest
 * @group SearchResponseConverterTest
 */
class SearchResponseConverterTest extends PHPUnit_Framework_TestCase
{

    /**
     * @return void
     */
    public function testConvert()
    {
        $converterFactory = $this->createConverterFactory();
        $searchAdapter = $this->createSearchAdapter();

        $searchResponseConverter = $this->createSearchResponseConverter($searchAdapter, $converterFactory);

        $expected = $this->createExpectedTransfer()
            ->toArray();
        $result = $searchResponseConverter->convert()
            ->toArray();

        $this->assertEquals($expected, $result);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|\SprykerEco\Client\FactFinder\Business\Api\Converter\ConverterFactory
     */
    protected function createConverterFactory()
    {
        return new ConverterFactory();
    }

    /**
     * @param \FACTFinder\Adapter\Search $searchAdapter
     * @param \SprykerEco\Client\FactFinder\Business\Api\Converter\ConverterFactory $converterFactory
     *
     * @return \PHPUnit_Framework_MockObject_MockObject|\SprykerEco\Client\FactFinder\Business\Api\Converter\SearchResponseConverter
     */
    protected function createSearchResponseConverter(Search $searchAdapter, ConverterFactory $converterFactory)
    {
        return new SearchResponseConverter(
            $searchAdapter,
            $converterFactory->createDataPagingConverter(),
            $converterFactory->createDataItemConverter(),
            $converterFactory->createDataRecordConverter(),
            $converterFactory->createDataFilterGroup(),
            $converterFactory->createDataAdvisorQuestionConverter()
        );
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|\FACTFinder\Adapter\Search
     */
    protected function createSearchAdapter()
    {
        $mock = $this->getMockBuilder(Search::class)
            ->setMethods([
                'getResponseContent',
                'convertServerQueryToClientUrl',
                'getResult',
            ])
            ->disableOriginalConstructor()
            ->getMock();

        $mock->method('getResponseContent')
                ->will($this->returnValue(json_decode('{"searchResult":{"breadCrumbTrailItems":[{"associatedFieldName":null,"searchParams":"\/Spryker\/Search.ff?query=HP+Pro+Tablet+608&channel=new-test&followSearch=9998&verbose=true&format=JSON","text":"HP Pro Tablet 608","type":"search","value":"HP Pro Tablet 608"}],"campaigns":[],"channel":"new-test","fieldRoles":{"campaignProductNumber":"ProductNumber","deeplink":"ProductURL","description":"Description","displayProductNumber":"ProductNumber","imageUrl":"ImageURL","masterArticleNumber":"","price":"Price","productName":"Name","trackingProductNumber":"ProductNumber"},"filters":[],"groups":[],"paging":{"currentPage":1,"firstLink":null,"lastLink":null,"nextLink":null,"pageCount":1,"pageLinks":[],"previousLink":null,"resultsPerPage":10},"records":[{"foundWords":[],"id":"111_28549472","keywords":[],"position":1,"record":{"__ORIG_POSITION__":"1","Category":"..Tablets..","Description":"Zum Lernen konzipiert Profitieren Sie von sofortiger Einsatzf\u00e4higkeit mit den neuen HP School Pack Tools und Inhalten zur Unterst\u00fctzung neuer Lernmethoden, darunter HP Classroom Manager, mit dem Lehrer das Klassenzimmer steuern, Klassen-PCs verwalten und mit Sch\u00fclern kommunizieren k\u00f6nnen. \tErzielen Sie ein 1:1-Lernerlebnis und steigern Sie das Engagement der Sch\u00fcler mit diesem Android?-Tablet, das speziell f\u00fcr Schulen entwickelt wurde. Das zuverl\u00e4ssige und robuste HP Pro Tablet 10 EE umfasst Lerntools und flexible Konnektivit\u00e4tsoptionen f\u00fcr ein Lernerlebnis \u00fcber das Klassenzimmer hinweg. Dar\u00fcber hinaus unterst\u00fctzen professionelle Support- und Serviceleistungen das Lehrpersonal bei der Einbindung neuer IT-Komponenten.","FFAutomaticSearchOptimization":"","DQAttributes":"","ImageURL":"http:\/\/images.icecat.biz\/img\/gallery\/28516206_9380.jpg","ProductNumber":"111_28549472","ProductURL":"\/fact-finder\/detail\/111_28549472","FFCheckoutCount":"0","Name":"HP Pro Tablet 608 G1","FFAfterSearchReorder":"","CategoryPath":"|CategoryPathROOT=Computer|CategoryPathROOT\/Computer=Tablets|","Price":"28178","Stock":"0"},"searchSimilarity":99.98,"simiMalusAdd":0},{"foundWords":[],"id":"111_28549472","keywords":[],"position":2,"record":{"__ORIG_POSITION__":"1","Category":"..Tablets..","Description":"Zum Lernen konzipiert Profitieren Sie von sofortiger Einsatzf\u00e4higkeit mit den neuen HP School Pack Tools und Inhalten zur Unterst\u00fctzung neuer Lernmethoden, darunter HP Classroom Manager, mit dem Lehrer das Klassenzimmer steuern, Klassen-PCs verwalten und mit Sch\u00fclern kommunizieren k\u00f6nnen. \tErzielen Sie ein 1:1-Lernerlebnis und steigern Sie das Engagement der Sch\u00fcler mit diesem Android?-Tablet, das speziell f\u00fcr Schulen entwickelt wurde. Das zuverl\u00e4ssige und robuste HP Pro Tablet 10 EE umfasst Lerntools und flexible Konnektivit\u00e4tsoptionen f\u00fcr ein Lernerlebnis \u00fcber das Klassenzimmer hinweg. Dar\u00fcber hinaus unterst\u00fctzen professionelle Support- und Serviceleistungen das Lehrpersonal bei der Einbindung neuer IT-Komponenten.","FFAutomaticSearchOptimization":"","DQAttributes":"","ImageURL":"http:\/\/images.icecat.biz\/img\/gallery\/28516206_9380.jpg","ProductNumber":"111_28549472","ProductURL":"\/fact-finder\/detail\/111_28549472","FFCheckoutCount":"0","Name":"HP Pro Tablet 608 G1","FFAfterSearchReorder":"","CategoryPath":"|CategoryPathROOT=Computer|CategoryPathROOT\/Computer=Tablets|","Price":"28178","Stock":"0"},"searchSimilarity":99.98,"simiMalusAdd":0}],"resultArticleNumberStatus":"noArticleNumberSearch","resultCount":2,"resultStatus":"resultsFound","resultsPerPageList":[{"default":false,"searchParams":"\/Spryker\/Search.ff?query=HP+Pro+Tablet+608&channel=new-test&followSearch=9998&verbose=true&format=JSON","selected":true,"value":10}],"searchControlParams":{"disableCache":false,"generateAdvisorTree":false,"idsOnly":false,"useAsn":true,"useAso":true,"useCampaigns":true,"useFoundWords":false,"useKeywords":false,"usePersonalization":true,"useSemanticEnhancer":true},"searchParams":"\/Spryker\/Search.ff?query=HP+Pro+Tablet+608&channel=new-test&followSearch=9998&verbose=true&format=JSON","searchTime":14,"simiFirstRecord":9998,"simiLastRecord":9998,"singleWordResults":null,"sortsList":[{"description":"sort.relevanceDescription","name":null,"order":"desc","searchParams":"\/Spryker\/Search.ff?query=HP+Pro+Tablet+608&channel=new-test&followSearch=9998&verbose=true&format=JSON","selected":true},{"description":"sort.titleAsc","name":"Name","order":"asc","searchParams":"\/Spryker\/Search.ff?query=HP+Pro+Tablet+608&sortName=asc&channel=new-test&followSearch=9998&verbose=true&format=JSON","selected":false},{"description":"sort.titleDesc","name":"Name","order":"desc","searchParams":"\/Spryker\/Search.ff?query=HP+Pro+Tablet+608&sortName=desc&channel=new-test&followSearch=9998&verbose=true&format=JSON","selected":false},{"description":"sort.priceAsc","name":"Price","order":"asc","searchParams":"\/Spryker\/Search.ff?query=HP+Pro+Tablet+608&sortPrice=asc&channel=new-test&followSearch=9998&verbose=true&format=JSON","selected":false},{"description":"sort.priceDesc","name":"Price","order":"desc","searchParams":"\/Spryker\/Search.ff?query=HP+Pro+Tablet+608&sortPrice=desc&channel=new-test&followSearch=9998&verbose=true&format=JSON","selected":false}],"timedOut":false}}', true)));
        $mock->method('convertServerQueryToClientUrl')
            ->will($this->returnValue(' '));
        $mock->method('getResult')
            ->will($this->returnValue($this->createResult()));

        return $mock;
    }

    /**
     * @return \FACTFinder\Data\Result
     */
    protected function createResult()
    {
        return new Result([
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
                2
            ),
        ], 2);
    }

    /**
     * @return \Generated\Shared\Transfer\FactFinderSearchResponseTransfer
     */
    protected function createExpectedTransfer()
    {
        $searchResponseTransfer = new FactFinderSearchResponseTransfer();

        $searchResponseTransfer->setCampaignIterator($this->getCampaignIteratorTransfer());
        $searchResponseTransfer->setAfterSearchNavigation($this->getAfterSearchNavigationTransfer());
        $searchResponseTransfer->setBreadCrumbs($this->getBreadCrumbsArray());
        $searchResponseTransfer->setPaging($this->getPagingTransfer());
        $searchResponseTransfer->setResult($this->getResultTransfer());
        $searchResponseTransfer->setResultsPerPageOptions($this->getResultPerPageTransfer());
        $searchResponseTransfer->setSingleWordSearchItems(new ArrayObject());
        $searchResponseTransfer->setSortingItems($this->getSortingItemsArray());
        $searchResponseTransfer->setFollowSearchValue('9998');
        $searchResponseTransfer->setIsSearchTimedOut(false);

        return $searchResponseTransfer;
    }

    /**
     * @return \Generated\Shared\Transfer\FactFinderDataResultsPerPageOptionsTransfer
     */
    protected function getResultPerPageTransfer()
    {
        $defaultOption = new FactFinderDataItemTransfer();
        $defaultOption->setLabel('10');
        $defaultOption->setSelected(true);
        $defaultOption->setUrl(' ');

        $defaultOptionArray = new ArrayObject();
        $defaultOptionArray->append($defaultOption);

        $resultPerPage = new FactFinderDataResultsPerPageOptionsTransfer();
        $resultPerPage->setDefaultOption($defaultOption);
        $resultPerPage->setSelectedOption($defaultOption);
        $resultPerPage->setItems($defaultOptionArray);

        return $resultPerPage;
    }

    /**
     * @return \Generated\Shared\Transfer\FactFinderDataPagingTransfer
     */
    protected function getPagingTransfer()
    {
        $paging = new FactFinderDataPagingTransfer();
        $paging->setPageCount(1);

        $emptyPageItem = new FactFinderDataPageTransfer();
        $paging->setFirstPage($emptyPageItem);
        $paging->setLastPage($emptyPageItem);
        $paging->setPreviousPage($emptyPageItem);
        $paging->setNextPage($emptyPageItem);

        $item = new FactFinderDataItemTransfer();
        $item->setUrl('#');
        $item->setLabel(1);
        $item->setSelected(true);

        $currentPage = new FactFinderDataPageTransfer();
        $currentPage->setPageNumber(1);
        $currentPage->setItem($item);

        $paging->setCurrentPage($currentPage);

        return $paging;
    }

    /**
     * @return \ArrayObject
     */
    protected function getBreadCrumbsArray()
    {
        $item = new FactFinderDataItemTransfer();
        $item->setLabel('HP Pro Tablet 608');
        $item->setSelected(true);
        $item->setUrl(' ');

        $breadCrumb = new FactFinderDataBreadCrumbTransfer();
        $breadCrumb->setIsFilterBreadCrumb(false);
        $breadCrumb->setIsSearchBreadCrumb(true);
        $breadCrumb->setFieldName('');
        $breadCrumb->setItem($item);

        $breadCrumbArray = new ArrayObject();
        $breadCrumbArray->append($breadCrumb);

        return $breadCrumbArray;
    }

    /**
     * @return \Generated\Shared\Transfer\FactFinderDataAfterSearchNavigationTransfer
     */
    protected function getAfterSearchNavigationTransfer()
    {
        $afterSearchNavigation = new FactFinderDataAfterSearchNavigationTransfer();
        $afterSearchNavigation->setFilterGroups(new ArrayObject());
        $afterSearchNavigation->setHasPreviewImages(false);

        return $afterSearchNavigation;
    }

    /**
     * @return \Generated\Shared\Transfer\FactFinderDataCampaignIteratorTransfer
     */
    protected function getCampaignIteratorTransfer()
    {
        $campaignIterator = new FactFinderDataCampaignIteratorTransfer();
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
        $campaignIterator->setHasFeedback(null);

        return $campaignIterator;
    }

    /**
     * @return \ArrayObject
     */
    protected function getSortingItemsArray()
    {
        $labels = [
            'sort.relevanceDescription',
            'sort.titleAsc',
            'sort.titleDesc',
            'sort.priceAsc',
            'sort.priceDesc',
        ];

        $resultArray = new ArrayObject();

        foreach ($labels as $label) {
            $sortingItem = new FactFinderDataItemTransfer();
            $sortingItem->setUrl(' ');
            $sortingItem->setLabel($label);

            if ($label == 'sort.relevanceDescription') {
                $sortingItem->setSelected(true);
            } else {
                $sortingItem->setSelected(false);
            }

            $resultArray->append($sortingItem);
        }

        return $resultArray;
    }

    /**
     * @return \Generated\Shared\Transfer\FactFinderDataResultTransfer
     */
    protected function getResultTransfer()
    {
        $dataRecord = new FactFinderDataRecordTransfer();
        $dataRecord->setFields([
            'ProductNumber' => '111_28549472',
            'Name' => 'HP Pro Tablet 608 G1',
            'Price' => '28178',
            'Stock' => '0',
            'Category' => '..Tablets..',
            'CategoryPath' => '|CategoryPathROOT=Computer|CategoryPathROOT/Computer=Tablets|',
            'ProductURL' => '/fact-finder/detail/111_28549472',
            'ImageURL' => 'http://images.icecat.biz/img/gallery/28516206_9380.jpg',
            'Description' => 'Zum Lernen konzipiert Profitieren Sie von sofortiger Einsatzfähigkeit mit den neuen HP School Pack Tools und Inhalten zur Unterstützung neuer Lernmethoden, darunter HP Classroom Manager, mit dem Lehrer das Klassenzimmer steuern, Klassen-PCs verwalten und mit Schülern kommunizieren können. Erzielen Sie ein 1:1-Lernerlebnis und steigern Sie das Engagement der Schüler mit diesem Android?-Tablet, das speziell für Schulen entwickelt wurde. Das zuverlässige und robuste HP Pro Tablet 10 EE umfasst Lerntools und flexible Konnektivitätsoptionen für ein Lernerlebnis über das Klassenzimmer hinweg. Darüber hinaus unterstützen professionelle Support- und Serviceleistungen das Lehrpersonal bei der Einbindung neuer IT-Komponenten.',
        ]);
        $dataRecord->setId('111_28549472');
        $dataRecord->setSimilarity(99.980000000000004);
        $dataRecord->setPosition(1);
        $dataRecord->setKeywords([]);
        $dataRecord->setSeoPath('');

        $result = new FactFinderDataResultTransfer();
        $result->setFoundRecordsCount(2);
        $result->setFieldNames([
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

        $recordsArray = new ArrayObject();

        $recordsArray->append($dataRecord);

        $dataRecordClone = clone $dataRecord;
        $dataRecordClone->setPosition(2);

        $recordsArray->append($dataRecordClone);

        $result->setRecords($recordsArray);

        return $result;
    }

}
