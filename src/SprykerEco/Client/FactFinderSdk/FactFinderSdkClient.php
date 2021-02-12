<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Client\FactFinderSdk;

use Generated\Shared\Transfer\FactFinderSdkProductCampaignRequestTransfer;
use Generated\Shared\Transfer\FactFinderSdkRecommendationRequestTransfer;
use Generated\Shared\Transfer\FactFinderSdkSearchRequestTransfer;
use Generated\Shared\Transfer\FactFinderSdkSuggestRequestTransfer;
use Generated\Shared\Transfer\FactFinderSdkTrackingRequestTransfer;
use Spryker\Client\Kernel\AbstractClient;

/**
 * @method \SprykerEco\Client\FactFinderSdk\FactFinderSdkFactory getFactory()
 */
class FactFinderSdkClient extends AbstractClient implements FactFinderSdkClientInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\FactFinderSdkSearchRequestTransfer $factFinderSearchRequestTransfer
     *
     * @return \Generated\Shared\Transfer\FactFinderSdkSearchResponseTransfer
     */
    public function search(FactFinderSdkSearchRequestTransfer $factFinderSearchRequestTransfer)
    {
        $factFinderSearchResponseTransfer = $this
            ->getFactory()
            ->createSearchRequest()
            ->request($factFinderSearchRequestTransfer);

        return $factFinderSearchResponseTransfer;
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\FactFinderSdkTrackingRequestTransfer $factFinderTrackingRequestTransfer
     *
     * @return \Generated\Shared\Transfer\FactFinderSdkTrackingResponseTransfer
     */
    public function track(FactFinderSdkTrackingRequestTransfer $factFinderTrackingRequestTransfer)
    {
        $factFinderTrackingResponseTransfer = $this->getFactory()
            ->createTrackingRequest()
            ->request($factFinderTrackingRequestTransfer);

        return $factFinderTrackingResponseTransfer;
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\FactFinderSdkSuggestRequestTransfer $factFinderSuggestRequestTransfer
     *
     * @return \Generated\Shared\Transfer\FactFinderSdkSuggestResponseTransfer
     */
    public function getSuggestions(FactFinderSdkSuggestRequestTransfer $factFinderSuggestRequestTransfer)
    {
        $factFinderSuggestResponseTransfer = $this
            ->getFactory()
            ->createSuggestRequest()
            ->request($factFinderSuggestRequestTransfer);

        return $factFinderSuggestResponseTransfer;
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\FactFinderSdkRecommendationRequestTransfer $factFinderRecommendationRequestTransfer
     *
     * @return \Generated\Shared\Transfer\FactFinderSdkRecommendationResponseTransfer
     */
    public function getRecommendations(FactFinderSdkRecommendationRequestTransfer $factFinderRecommendationRequestTransfer)
    {
        $factFinderRecommendationResponseTransfer = $this
            ->getFactory()
            ->createRecommendationsRequest()
            ->request($factFinderRecommendationRequestTransfer);

        return $factFinderRecommendationResponseTransfer;
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\FactFinderSdkProductCampaignRequestTransfer $factFinderSdkProductCampaignRequestTransfer
     *
     * @return \Generated\Shared\Transfer\FactFinderSdkProductCampaignResponseTransfer
     */
    public function getProductCampaigns(FactFinderSdkProductCampaignRequestTransfer $factFinderSdkProductCampaignRequestTransfer)
    {
        $factFinderSdkProductCampaignResponseTransfer = $this
            ->getFactory()
            ->createProductCampaignRequest()
            ->request($factFinderSdkProductCampaignRequestTransfer);

        return $factFinderSdkProductCampaignResponseTransfer;
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\FactFinderSdkProductCampaignRequestTransfer $factFinderSdkProductCampaignRequestTransfer
     *
     * @return \Generated\Shared\Transfer\FactFinderSdkProductCampaignResponseTransfer
     */
    public function getShoppingCartCampaigns(FactFinderSdkProductCampaignRequestTransfer $factFinderSdkProductCampaignRequestTransfer)
    {
        $factFinderSdkProductCampaignResponseTransfer = $this
            ->getFactory()
            ->createShoppingCartCampaignRequest()
            ->request($factFinderSdkProductCampaignRequestTransfer);

        return $factFinderSdkProductCampaignResponseTransfer;
    }
}
