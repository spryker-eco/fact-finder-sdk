<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Client\FactFinderSdk\Business\Api;

use FACTFinder\Util\Parameters;
use Generated\Shared\Transfer\FactFinderSdkProductCampaignRequestTransfer;
use Generated\Shared\Transfer\FactFinderSdkSearchRequestTransfer;

interface FactFinderConnectorInterface
{
    /**
     * @return \FACTFinder\Adapter\Search
     */
    public function createSearchAdapter();

    /**
     * @return \FACTFinder\Adapter\TagCloud
     */
    public function createTagCloudAdapter();

    /**
     * @return \FACTFinder\Adapter\Recommendation
     */
    public function createRecommendationAdapter();

    /**
     * @return \FACTFinder\Adapter\Suggest
     */
    public function createSuggestAdapter();

    /**
     * @return \FACTFinder\Adapter\Tracking
     */
    public function createTrackingAdapter();

    /**
     * @return \FACTFinder\Adapter\SimilarRecords
     */
    public function createSimilarRecordsAdapter();

    /**
     * @return \FACTFinder\Adapter\ProductCampaign
     */
    public function createProductCampaignAdapter();

    /**
     * @return \FACTFinder\Adapter\Import
     */
    public function createImportAdapter();

    /**
     * @return \FACTFinder\Adapter\Compare
     */
    public function createCompareAdapter();

    /**
     * @return string
     */
    public function getPageContentEncoding();

    /**
     * @return \FACTFinder\Util\Parameters
     */
    public function getRequestParameters();

    /**
     * @param \FACTFinder\Util\Parameters $requestParameters
     *
     * @return void
     */
    public function setRequestParameters($requestParameters);

    /**
     * @param \Generated\Shared\Transfer\FactFinderSdkSearchRequestTransfer $searchRequestTransfer
     *
     * @return \FACTFinder\Util\Parameters
     */
    public function createRequestParametersFromSearchRequestTransfer(FactFinderSdkSearchRequestTransfer $searchRequestTransfer);

    /**
     * @param \Generated\Shared\Transfer\FactFinderSdkProductCampaignRequestTransfer $factFinderProductCampaignRequestTransfer
     *
     * @return \FACTFinder\Util\Parameters
     */
    public function createRequestParametersFromProductCampaignRequestTransfer(FactFinderSdkProductCampaignRequestTransfer $factFinderProductCampaignRequestTransfer);

    /**
     * @return \FACTFinder\Util\Parameters
     */
    public function createRequestParametersFromRequestParser();

    /**
     * @param \FACTFinder\Util\Parameters $parameters
     *
     * @return \FACTFinder\Data\SearchParameters
     */
    public function createSearchParameters(Parameters $parameters);

    /**
     * @return \FACTFinder\Data\SearchParameters
     */
    public function createSearchParametersFromRequestParser();

    /**
     * @return string
     */
    public function getRequestTarget();

    /**
     * @return string
     */
    public function getSessionId();

    /**
     * @return \FACTFinder\Data\SearchStatus
     */
    public function getSearchStatusEnum();

    /**
     * @return \FACTFinder\Data\ArticleNumberSearchStatus
     */
    public function getArticleNumberSearchStatusEnum();
}
