<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Client\FactFinderSdk\Business\Api\Converter;

use FACTFinder\Adapter\ProductCampaign as FactFinderProductCampaignAdapter;
use FACTFinder\Adapter\Recommendation as FactFinderRecommendationAdapter;
use FACTFinder\Adapter\Search as FactFinderSearchAdapter;
use FACTFinder\Adapter\SimilarRecords as FactFinderSimilarRecordsAdapter;
use FACTFinder\Adapter\Suggest as FactFinderSuggestAdapter;
use FACTFinder\Adapter\TagCloud as FactFinderTagCloudAdapter;
use FACTFinder\Adapter\Tracking as FactFinderTrackingAdapter;
use SprykerEco\Client\FactFinderSdk\Business\Api\Converter\Data\AdvisorQuestionConverter;
use SprykerEco\Client\FactFinderSdk\Business\Api\Converter\Data\FilterGroupConverter;
use SprykerEco\Client\FactFinderSdk\Business\Api\Converter\Data\ItemConverter;
use SprykerEco\Client\FactFinderSdk\Business\Api\Converter\Data\PagingConverter;
use SprykerEco\Client\FactFinderSdk\Business\Api\Converter\Data\RecordConverter;
use SprykerEco\Client\FactFinderSdk\FactFinderSdkConfig;

class ConverterFactory
{

    /**
     * @var \SprykerEco\Client\FactFinderSdk\FactFinderSdkConfig
     */
    protected $factFinderSdkConfig;

    /**
     * @param \SprykerEco\Client\FactFinderSdk\FactFinderSdkConfig $factFinderSdkConfig
     */
    public function __construct(FactFinderSdkConfig $factFinderSdkConfig)
    {
        $this->factFinderSdkConfig = $factFinderSdkConfig;
    }

    /**
     * @param \FACTFinder\Adapter\Search $searchAdapter
     *
     * @return \SprykerEco\Client\FactFinderSdk\Business\Api\Converter\SearchResponseConverter
     */
    public function createSearchResponseConverter(FactFinderSearchAdapter $searchAdapter)
    {
        return new SearchResponseConverter(
            $searchAdapter,
            $this->createDataPagingConverter(),
            $this->createDataItemConverter(),
            $this->createDataRecordConverter(),
            $this->createDataFilterGroup(),
            $this->createDataAdvisorQuestionConverter(),
            $this->factFinderSdkConfig
        );
    }

    /**
     * @param \FACTFinder\Adapter\Recommendation $recommendationAdapter
     *
     * @return \SprykerEco\Client\FactFinderSdk\Business\Api\Converter\RecommendationResponseConverter
     */
    public function createRecommendationResponseConverter(FactFinderRecommendationAdapter $recommendationAdapter)
    {
        return new RecommendationResponseConverter($recommendationAdapter);
    }

    /**
     * @param \FACTFinder\Adapter\Suggest $suggestAdapter
     *
     * @return \SprykerEco\Client\FactFinderSdk\Business\Api\Converter\SuggestResponseConverter
     */
    public function createSuggestResponseConverter(FactFinderSuggestAdapter $suggestAdapter)
    {
        return new SuggestResponseConverter($suggestAdapter);
    }

    /**
     * @param \FACTFinder\Adapter\TagCloud $tagCloudAdapter
     *
     * @return \SprykerEco\Client\FactFinderSdk\Business\Api\Converter\TagCloudResponseConverter
     */
    public function createTagCloudResponseConverter(FactFinderTagCloudAdapter $tagCloudAdapter)
    {
        return new TagCloudResponseConverter($tagCloudAdapter);
    }

    /**
     * @param \FACTFinder\Adapter\Tracking $trackingAdapter
     *
     * @return \SprykerEco\Client\FactFinderSdk\Business\Api\Converter\TrackingResponseConverter
     */
    public function createTrackingResponseConverter(FactFinderTrackingAdapter $trackingAdapter)
    {
        return new TrackingResponseConverter($trackingAdapter);
    }

    /**
     * @param \FACTFinder\Adapter\SimilarRecords $similarRecordsAdapter
     *
     * @return \SprykerEco\Client\FactFinderSdk\Business\Api\Converter\SimilarRecordsResponseConverter
     */
    public function createSimilarRecordsResponseConverter(FactFinderSimilarRecordsAdapter $similarRecordsAdapter)
    {
        return new SimilarRecordsResponseConverter($similarRecordsAdapter);
    }

    /**
     * @param \FACTFinder\Adapter\ProductCampaign $productCampaignAdapter
     *
     * @return \SprykerEco\Client\FactFinderSdk\Business\Api\Converter\ProductCampaignResponseConverter
     */
    public function createProductCampaignResponseConverter(FactFinderProductCampaignAdapter $productCampaignAdapter)
    {
        return new ProductCampaignResponseConverter($productCampaignAdapter);
    }

    /**
     * @return \SprykerEco\Client\FactFinderSdk\Business\Api\Converter\Data\ItemConverter
     */
    public function createDataItemConverter()
    {
        return new ItemConverter();
    }

    /**
     * @return \SprykerEco\Client\FactFinderSdk\Business\Api\Converter\Data\PagingConverter
     */
    public function createDataPagingConverter()
    {
        return new PagingConverter(
            $this->createDataItemConverter()
        );
    }

    /**
     * @return \SprykerEco\Client\FactFinderSdk\Business\Api\Converter\Data\RecordConverter
     */
    public function createDataRecordConverter()
    {
        return new RecordConverter($this->factFinderSdkConfig);
    }

    /**
     * @return \SprykerEco\Client\FactFinderSdk\Business\Api\Converter\Data\FilterGroupConverter
     */
    public function createDataFilterGroup()
    {
        return new FilterGroupConverter(
            $this->createDataItemConverter()
        );
    }

    /**
     * @return \SprykerEco\Client\FactFinderSdk\Business\Api\Converter\Data\AdvisorQuestionConverter
     */
    public function createDataAdvisorQuestionConverter()
    {
        return new AdvisorQuestionConverter(
            $this->createDataItemConverter()
        );
    }

}
