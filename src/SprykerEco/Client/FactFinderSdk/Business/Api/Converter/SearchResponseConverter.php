<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Client\FactFinderSdk\Business\Api\Converter;

use ArrayObject;
use FACTFinder\Adapter\Search as FactFinderSearchAdapter;
use FACTFinder\Data\AfterSearchNavigation;
use FACTFinder\Data\BreadCrumbTrail;
use FACTFinder\Data\CampaignIterator;
use FACTFinder\Data\Result;
use FACTFinder\Data\ResultsPerPageOptions;
use FACTFinder\Data\Sorting;
use FACTFinder\Data\SuggestQuery;
use Generated\Shared\Transfer\FactFinderSdkDataAfterSearchNavigationTransfer;
use Generated\Shared\Transfer\FactFinderSdkDataBreadCrumbTransfer;
use Generated\Shared\Transfer\FactFinderSdkDataCampaignIteratorTransfer;
use Generated\Shared\Transfer\FactFinderSdkDataCampaignTransfer;
use Generated\Shared\Transfer\FactFinderSdkDataResultsPerPageOptionsTransfer;
use Generated\Shared\Transfer\FactFinderSdkDataResultTransfer;
use Generated\Shared\Transfer\FactFinderSdkDataSingleWordSearchItemTransfer;
use Generated\Shared\Transfer\FactFinderSdkDataSuggestQueryTransfer;
use Generated\Shared\Transfer\FactFinderSdkSearchResponseTransfer;
use SprykerEco\Client\FactFinderSdk\Business\Api\Converter\Data\AdvisorQuestionConverter;
use SprykerEco\Client\FactFinderSdk\Business\Api\Converter\Data\FilterGroupConverter;
use SprykerEco\Client\FactFinderSdk\Business\Api\Converter\Data\ItemConverter;
use SprykerEco\Client\FactFinderSdk\Business\Api\Converter\Data\PagingConverter;
use SprykerEco\Client\FactFinderSdk\Business\Api\Converter\Data\RecordConverter;
use SprykerEco\Client\FactFinderSdk\FactFinderSdkConfig;

class SearchResponseConverter extends BaseConverter
{

    /**
     * @var \FACTFinder\Adapter\Search
     */
    protected $searchAdapter;

    /**
     * @var \Generated\Shared\Transfer\FactFinderSdkSearchResponseTransfer
     */
    protected $responseTransfer;

    /**
     * @var \SprykerEco\Client\FactFinderSdk\Business\Api\Converter\Data\PagingConverter
     */
    protected $pagingConverter;

    /**
     * @var \SprykerEco\Client\FactFinderSdk\Business\Api\Converter\Data\ItemConverter
     */
    protected $itemConverter;

    /**
     * @var \SprykerEco\Client\FactFinderSdk\Business\Api\Converter\Data\RecordConverter
     */
    protected $recordConverter;

    /**
     * @var \SprykerEco\Client\FactFinderSdk\Business\Api\Converter\Data\FilterGroupConverter
     */
    protected $filterGroupConverter;

    /**
     * @var \SprykerEco\Client\FactFinderSdk\Business\Api\Converter\Data\AdvisorQuestionConverter
     */
    protected $advisorQuestionConverter;

    /**
     * @var \SprykerEco\Client\FactFinderSdk\FactFinderSdkConfig
     */
    private $factFinderSdkConfig;

    /**
     * @param \FACTFinder\Adapter\Search $searchAdapter
     * @param \SprykerEco\Client\FactFinderSdk\Business\Api\Converter\Data\PagingConverter $pagingConverter
     * @param \SprykerEco\Client\FactFinderSdk\Business\Api\Converter\Data\ItemConverter $itemConverter
     * @param \SprykerEco\Client\FactFinderSdk\Business\Api\Converter\Data\RecordConverter $recordConverter
     * @param \SprykerEco\Client\FactFinderSdk\Business\Api\Converter\Data\FilterGroupConverter $filterGroupConverter
     * @param \SprykerEco\Client\FactFinderSdk\Business\Api\Converter\Data\AdvisorQuestionConverter $advisorQuestionConverter
     * @param \SprykerEco\Client\FactFinderSdk\FactFinderSdkConfig $factFinderSdkConfig
     */
    public function __construct(
        FactFinderSearchAdapter $searchAdapter,
        PagingConverter $pagingConverter,
        ItemConverter $itemConverter,
        RecordConverter $recordConverter,
        FilterGroupConverter $filterGroupConverter,
        AdvisorQuestionConverter $advisorQuestionConverter,
        FactFinderSdkConfig $factFinderSdkConfig
    ) {
        $this->searchAdapter = $searchAdapter;
        $this->pagingConverter = $pagingConverter;
        $this->itemConverter = $itemConverter;
        $this->recordConverter = $recordConverter;
        $this->filterGroupConverter = $filterGroupConverter;
        $this->advisorQuestionConverter = $advisorQuestionConverter;
        $this->factFinderSdkConfig = $factFinderSdkConfig;
    }

    /**
     * @return \Generated\Shared\Transfer\FactFinderSdkSearchResponseTransfer
     */
    public function convert()
    {
        $this->responseTransfer = new FactFinderSdkSearchResponseTransfer();

        $this->responseTransfer->setCampaignIterator(
            $this->convertCampaigns($this->searchAdapter->getCampaigns())
        );
        $this->responseTransfer->setAfterSearchNavigation(
            $this->convertAfterSearchNavigation($this->searchAdapter->getAfterSearchNavigation())
        );
        $this->responseTransfer->setBreadCrumbs(
            $this->convertBreadCrumbTrail($this->searchAdapter->getBreadCrumbTrail())
        );
        $this->pagingConverter->setPaging($this->searchAdapter->getPaging());
        $this->responseTransfer->setPaging(
            $this->pagingConverter->convert()
        );
        $this->responseTransfer->setResult(
            $this->convertResult($this->searchAdapter->getResult())
        );
        $this->responseTransfer->setResultsPerPageOptions(
            $this->convertResultsPerPageOptions($this->searchAdapter->getResultsPerPageOptions())
        );
        $this->responseTransfer->setSingleWordSearchItems(
            $this->convertSingleWordSearch($this->searchAdapter->getSingleWordSearch())
        );
        $this->responseTransfer->setSortingItems(
            $this->convertSorting($this->searchAdapter->getSorting())
        );
        $this->responseTransfer->setIsSearchTimedOut(
            $this->searchAdapter->isSearchTimedOut()
        );
        $this->responseTransfer->setFollowSearchValue(
            $this->searchAdapter->getFollowSearchValue()
        );

        return $this->responseTransfer;
    }

    /**
     * @param \FACTFinder\Data\CampaignIterator $campaigns
     *
     * @return \Generated\Shared\Transfer\FactFinderSdkDataCampaignIteratorTransfer
     */
    protected function convertCampaigns(CampaignIterator $campaigns)
    {
        $factFinderDataCampaignIteratorTransfer = new FactFinderSdkDataCampaignIteratorTransfer();
        $factFinderDataCampaignIteratorTransfer->setHasRedirect($campaigns->hasRedirect());
        $factFinderDataCampaignIteratorTransfer->setRedirectUrl($campaigns->getRedirectUrl());
        $factFinderDataCampaignIteratorTransfer->setHasFeedback($campaigns->hasFeedback());
        $factFinderDataCampaignIteratorTransfer->setHasPushedProducts($campaigns->hasPushedProducts());
        /** @var \FACTFinder\Data\Record $pushedProduct */
        foreach ($campaigns->getPushedProducts() as $pushedProduct) {
            $this->recordConverter->setRecord($pushedProduct);
            $factFinderDataCampaignIteratorTransfer->addPushedProducts(
                $this->recordConverter->convert()
            );
        }
        $factFinderDataCampaignIteratorTransfer->setHasActiveQuestions($campaigns->hasActiveQuestions());
        $factFinderDataCampaignIteratorTransfer->setHasAdvisorTree($campaigns->hasAdvisorTree());
        /** @var \FACTFinder\Data\Record $advisorTree */
        foreach ($campaigns->getAdvisorTree() as $advisorTree) {
            $this->recordConverter->setRecord($advisorTree);
            $factFinderDataCampaignIteratorTransfer->addAdvisorTree(
                $this->recordConverter->convert()
            );
        }

        /** @var \FACTFinder\Data\Campaign $campaign */
        foreach ($campaigns as $campaign) {
            $factFinderDataCampaignTransfer = new FactFinderSdkDataCampaignTransfer();
            $factFinderDataCampaignTransfer->setName($campaign->getName());
            $factFinderDataCampaignTransfer->setCategory($campaign->getCategory());
            $factFinderDataCampaignTransfer->setRedirectUrl($campaign->getRedirectUrl());
            $factFinderDataCampaignTransfer->setFeedback($campaign->getFeedbackArray());
            $factFinderDataCampaignTransfer->setHasRedirect($campaign->hasRedirect());
            $factFinderDataCampaignTransfer->setHasPushedProducts($campaign->hasPushedProducts());
            /** @var \FACTFinder\Data\Record $pushedProduct */
            foreach ($campaign->getPushedProducts() as $pushedProduct) {
                $this->recordConverter->setRecord($pushedProduct);
                $factFinderDataCampaignTransfer->addPushedProducts(
                    $this->recordConverter->convert()
                );
            }
            /** @var \FACTFinder\Data\AdvisorQuestion $activeQuestion */
            foreach ($campaign->getActiveQuestions() as $activeQuestion) {
                $this->advisorQuestionConverter->setAdvisorQuestion($activeQuestion);
                $factFinderDataCampaignTransfer->addActiveQuestions(
                    $this->advisorQuestionConverter->convert($activeQuestion)
                );
            }
            /** @var \FACTFinder\Data\AdvisorQuestion $advisorTree */
            foreach ($campaign->getAdvisorTree() as $advisorTree) {
                $this->advisorQuestionConverter->setAdvisorQuestion($advisorTree);
                $factFinderDataCampaignTransfer->addAdvisorTree(
                    $this->advisorQuestionConverter->convert()
                );
            }

            $factFinderDataCampaignIteratorTransfer->addCampaigns($factFinderDataCampaignTransfer);
        }

        return $factFinderDataCampaignIteratorTransfer;
    }

    /**
     * @param \FACTFinder\Data\AfterSearchNavigation $afterSearchNavigation
     *
     * @return \Generated\Shared\Transfer\FactFinderSdkDataAfterSearchNavigationTransfer
     */
    protected function convertAfterSearchNavigation(AfterSearchNavigation $afterSearchNavigation)
    {
        $factFinderDataAfterSearchNavigationTransfer = new FactFinderSdkDataAfterSearchNavigationTransfer();
        $factFinderDataAfterSearchNavigationTransfer->setHasPreviewImages($afterSearchNavigation->hasPreviewImages());

        /** @var \FACTFinder\Data\FilterGroup $filterGroup */
        foreach ($afterSearchNavigation as $filterGroup) {
            $this->filterGroupConverter->setFilterGroup($filterGroup);
            $factFinderDataAfterSearchNavigationTransfer->addFilterGroups(
                $this->filterGroupConverter->convert()
            );
        }

        return $factFinderDataAfterSearchNavigationTransfer;
    }

    /**
     * @param \FACTFinder\Data\BreadCrumbTrail $breadCrumbTrail
     *
     * @return \ArrayObject|\Generated\Shared\Transfer\FactFinderSdkDataBreadCrumbTransfer[]
     */
    protected function convertBreadCrumbTrail(BreadCrumbTrail $breadCrumbTrail)
    {
        $breadCrumbs = new ArrayObject();
        /** @var \FACTFinder\Data\BreadCrumb $breadCrumb */
        foreach ($breadCrumbTrail as $breadCrumb) {
            $factFinderDataBreadCrumbTransfer = new FactFinderSdkDataBreadCrumbTransfer();
            $factFinderDataBreadCrumbTransfer->setIsSearchBreadCrumb($breadCrumb->isSearchBreadCrumb());
            $factFinderDataBreadCrumbTransfer->setIsFilterBreadCrumb($breadCrumb->isFilterBreadCrumb());
            $factFinderDataBreadCrumbTransfer->setFieldName($breadCrumb->getFieldName());

            $this->itemConverter->setItem($breadCrumb);
            $factFinderDataBreadCrumbTransfer->setItem($this->itemConverter->convert());

            $breadCrumbs->append($factFinderDataBreadCrumbTransfer);
        }

        return $breadCrumbs;
    }

    /**
     * @param \FACTFinder\Data\Result $result
     *
     * @return \Generated\Shared\Transfer\FactFinderSdkDataResultTransfer
     */
    protected function convertResult(Result $result)
    {
        $factFinderDataResultTransfer = new FactFinderSdkDataResultTransfer();
        $factFinderDataResultTransfer->setFoundRecordsCount($result->getFoundRecordsCount());
        $factFinderDataResultTransfer->setFieldNames($this->factFinderSdkConfig->getItemFields());
        /** @var \FACTFinder\Data\Record $record */
        foreach ($result as $record) {
            $this->recordConverter->setRecord($record);
            $factFinderDataResultTransfer->addRecords(
                $this->recordConverter->convert()
            );
        }

        return $factFinderDataResultTransfer;
    }

    /**
     * @param \FACTFinder\Data\ResultsPerPageOptions $resultsPerPageOptions
     *
     * @return \Generated\Shared\Transfer\FactFinderSdkDataResultsPerPageOptionsTransfer
     */
    protected function convertResultsPerPageOptions(ResultsPerPageOptions $resultsPerPageOptions)
    {
        $factFinderDataResultsPerPageOptionsTransfer = new FactFinderSdkDataResultsPerPageOptionsTransfer();

        $this->itemConverter->setItem($resultsPerPageOptions->getDefaultOption());
        $factFinderDataResultsPerPageOptionsTransfer->setDefaultOption(
            $this->itemConverter->convert()
        );
        $this->itemConverter->setItem($resultsPerPageOptions->getSelectedOption());
        $factFinderDataResultsPerPageOptionsTransfer->setSelectedOption(
            $this->itemConverter->convert()
        );
        /** @var \FACTFinder\Data\Item $resultsPerPageOption */
        foreach ($resultsPerPageOptions as $resultsPerPageOption) {
            $this->itemConverter->setItem($resultsPerPageOption);
            $factFinderDataResultsPerPageOptionsTransfer->addItems(
                $this->itemConverter->convert()
            );
        }

        return $factFinderDataResultsPerPageOptionsTransfer;
    }

    /**
     * @param \FACTFinder\Data\SingleWordSearchItem[] $singleWordSearch
     *
     * @return \ArrayObject|\Generated\Shared\Transfer\FactFinderSdkDataSingleWordSearchItemTransfer[]
     */
    protected function convertSingleWordSearch($singleWordSearch)
    {
        $singleWordSearchItems = new ArrayObject();
        foreach ($singleWordSearch as $singleWordSearchItem) {
            $factFinderDataSingleWordSearchItemTransfer = new FactFinderSdkDataSingleWordSearchItemTransfer();
            /** @var \FACTFinder\Data\Record $previewRecord */
            foreach ($singleWordSearchItem->getPreviewRecords() as $previewRecord) {
                $this->recordConverter->setRecord($previewRecord);
                $factFinderDataSingleWordSearchItemTransfer->addPreviewRecords(
                    $this->recordConverter->convert()
                );
            }
            $factFinderDataSingleWordSearchItemTransfer->setSuggestQuery(
                $this->convertSuggestQuery($singleWordSearchItem)
            );

            $singleWordSearchItems->append($factFinderDataSingleWordSearchItemTransfer);
        }

        return $singleWordSearchItems;
    }

    /**
     * @param \FACTFinder\Data\SuggestQuery $suggestQuery
     *
     * @return \Generated\Shared\Transfer\FactFinderSdkDataSuggestQueryTransfer
     */
    protected function convertSuggestQuery(SuggestQuery $suggestQuery)
    {
        $factFinderDataSuggestQueryTransfer = new FactFinderSdkDataSuggestQueryTransfer();
        $factFinderDataSuggestQueryTransfer->setHitCount($suggestQuery->getHitCount());
        $factFinderDataSuggestQueryTransfer->setType($suggestQuery->getType());
        $factFinderDataSuggestQueryTransfer->setImageUrl($suggestQuery->getImageUrl());
        $factFinderDataSuggestQueryTransfer->setAttributes($suggestQuery->getAttributes());

        return $factFinderDataSuggestQueryTransfer;
    }

    /**
     * @param \FACTFinder\Data\Sorting $sorting
     *
     * @return \ArrayObject|\Generated\Shared\Transfer\FactFinderSdkDataItemTransfer[]
     */
    protected function convertSorting(Sorting $sorting)
    {
        $sortingItems = new ArrayObject();
        /** @var \FACTFinder\Data\Item $sortingItem */
        foreach ($sorting as $sortingItem) {
            $this->itemConverter->setItem($sortingItem);

            $sortingItems->append($this->itemConverter->convert());
        }

        return $sortingItems;
    }

}
