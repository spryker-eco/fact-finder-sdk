<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Client\FactFinderSdk\Business\Api\Converter;

use ArrayObject;
use FACTFinder\Adapter\Search as FactFinderSearchAdapter;
use FACTFinder\Data\AfterSearchNavigation;
use FACTFinder\Data\ArticleNumberSearchStatus;
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
use Generated\Shared\Transfer\FactFinderSearchRedirectTransfer;
use SprykerEco\Client\FactFinderSdk\Business\Api\Converter\Data\AdvisorQuestionConverterInterface;
use SprykerEco\Client\FactFinderSdk\Business\Api\Converter\Data\FilterGroupConverterInterface;
use SprykerEco\Client\FactFinderSdk\Business\Api\Converter\Data\ItemConverterInterface;
use SprykerEco\Client\FactFinderSdk\Business\Api\Converter\Data\PagingConverterInterface;
use SprykerEco\Client\FactFinderSdk\Business\Api\Converter\Data\RecordConverterInterface;
use SprykerEco\Client\FactFinderSdk\FactFinderSdkConfig;
use SprykerEco\Shared\FactFinderSdk\FactFinderSdkConstants;

class SearchResponseConverter extends BaseConverter implements ConverterInterface
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
     * @var \SprykerEco\Client\FactFinderSdk\Business\Api\Converter\Data\PagingConverterInterface
     */
    protected $pagingConverter;

    /**
     * @var \SprykerEco\Client\FactFinderSdk\Business\Api\Converter\Data\ItemConverterInterface
     */
    protected $itemConverter;

    /**
     * @var \SprykerEco\Client\FactFinderSdk\Business\Api\Converter\Data\RecordConverterInterface
     */
    protected $recordConverter;

    /**
     * @var \SprykerEco\Client\FactFinderSdk\Business\Api\Converter\Data\FilterGroupConverterInterface
     */
    protected $filterGroupConverter;

    /**
     * @var \SprykerEco\Client\FactFinderSdk\Business\Api\Converter\Data\AdvisorQuestionConverterInterface
     */
    protected $advisorQuestionConverter;

    /**
     * @var \SprykerEco\Client\FactFinderSdk\FactFinderSdkConfig
     */
    private $factFinderSdkConfig;

    /**
     * @param \FACTFinder\Adapter\Search $searchAdapter
     * @param \SprykerEco\Client\FactFinderSdk\Business\Api\Converter\Data\PagingConverterInterface $pagingConverter
     * @param \SprykerEco\Client\FactFinderSdk\Business\Api\Converter\Data\ItemConverterInterface $itemConverter
     * @param \SprykerEco\Client\FactFinderSdk\Business\Api\Converter\Data\RecordConverterInterface $recordConverter
     * @param \SprykerEco\Client\FactFinderSdk\Business\Api\Converter\Data\FilterGroupConverterInterface $filterGroupConverter
     * @param \SprykerEco\Client\FactFinderSdk\Business\Api\Converter\Data\AdvisorQuestionConverterInterface $advisorQuestionConverter
     * @param \SprykerEco\Client\FactFinderSdk\FactFinderSdkConfig $factFinderSdkConfig
     */
    public function __construct(
        FactFinderSearchAdapter $searchAdapter,
        PagingConverterInterface $pagingConverter,
        ItemConverterInterface $itemConverter,
        RecordConverterInterface $recordConverter,
        FilterGroupConverterInterface $filterGroupConverter,
        AdvisorQuestionConverterInterface $advisorQuestionConverter,
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
        $this->responseTransfer->setSearchRedirect(
            $this->getSearchRedirect($this->responseTransfer)
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
            $factFinderDataCampaignIteratorTransfer->addPushedProduct(
                $this->recordConverter->convert()
            );
        }
        $factFinderDataCampaignIteratorTransfer->setHasActiveQuestions($campaigns->hasActiveQuestions());
        $factFinderDataCampaignIteratorTransfer->setHasAdvisorTree($campaigns->hasAdvisorTree());
        /** @var \FACTFinder\Data\Record $advisorTree */
        foreach ($campaigns->getAdvisorTree() as $advisorTree) {
            $this->recordConverter->setRecord($advisorTree);
            $factFinderDataCampaignIteratorTransfer->addAdvisor(
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
                $factFinderDataCampaignTransfer->addPushedProduct(
                    $this->recordConverter->convert()
                );
            }
            /** @var \FACTFinder\Data\AdvisorQuestion $activeQuestion */
            foreach ($campaign->getActiveQuestions() as $activeQuestion) {
                $this->advisorQuestionConverter->setAdvisorQuestion($activeQuestion);
                $factFinderDataCampaignTransfer->addActiveQuestion(
                    $this->advisorQuestionConverter->convert($activeQuestion)
                );
            }
            /** @var \FACTFinder\Data\AdvisorQuestion $advisorTree */
            foreach ($campaign->getAdvisorTree() as $advisorTree) {
                $this->advisorQuestionConverter->setAdvisorQuestion($advisorTree);
                $factFinderDataCampaignTransfer->addAdvisor(
                    $this->advisorQuestionConverter->convert()
                );
            }

            $factFinderDataCampaignIteratorTransfer->addCampaign($factFinderDataCampaignTransfer);
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
            $factFinderDataAfterSearchNavigationTransfer->addFilterGroup(
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
            $factFinderDataResultTransfer->addRecord(
                $this->recordConverter->convert()
            );
        }

        return $factFinderDataResultTransfer;
    }

    /**
     * @param \FACTFinder\Data\ResultsPerPageOptions|null $resultsPerPageOptions
     *
     * @return \Generated\Shared\Transfer\FactFinderSdkDataResultsPerPageOptionsTransfer
     */
    protected function convertResultsPerPageOptions(?ResultsPerPageOptions $resultsPerPageOptions = null)
    {
        $factFinderDataResultsPerPageOptionsTransfer = new FactFinderSdkDataResultsPerPageOptionsTransfer();

        if ($resultsPerPageOptions === null) {
            return $factFinderDataResultsPerPageOptionsTransfer;
        }

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
            $factFinderDataResultsPerPageOptionsTransfer->addItem(
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
                $factFinderDataSingleWordSearchItemTransfer->addPreviewRecord(
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
     * @param \FACTFinder\Data\Sorting|null $sorting
     *
     * @return \ArrayObject|\Generated\Shared\Transfer\FactFinderSdkDataItemTransfer[]
     */
    protected function convertSorting(?Sorting $sorting = null)
    {
        $sortingItems = new ArrayObject();

        if ($sorting === null) {
            return $sortingItems;
        }

        /** @var \FACTFinder\Data\Item $sortingItem */
        foreach ($sorting as $sortingItem) {
            $this->itemConverter->setItem($sortingItem);

            $sortingItems->append($this->itemConverter->convert());
        }

        return $sortingItems;
    }

    /**
     * @param \Generated\Shared\Transfer\FactFinderSdkSearchResponseTransfer $sdkSearchResponseTransfer
     *
     * @return \Generated\Shared\Transfer\FactFinderSearchRedirectTransfer
     */
    protected function getSearchRedirect(FactFinderSdkSearchResponseTransfer $sdkSearchResponseTransfer)
    {
        $searchRedirectTransfer = new FactFinderSearchRedirectTransfer();
        $articleNumberStatus = $this->searchAdapter->getArticleNumberStatus();
        $foundRecordsCount = $sdkSearchResponseTransfer->getResult()->getFoundRecordsCount();

        if ($foundRecordsCount !== 1 || $articleNumberStatus !== ArticleNumberSearchStatus::IsArticleNumberResultFound()) {
            return $searchRedirectTransfer;
        }

        $record = $sdkSearchResponseTransfer->getResult()->getRecords()[0];
        $productUrl = $record->getFields()[FactFinderSdkConstants::ITEM_PRODUCT_URL];
        $searchRedirectTransfer->setUrl($productUrl);
        $searchRedirectTransfer->setRedirect(true);

        return $searchRedirectTransfer;
    }
}
