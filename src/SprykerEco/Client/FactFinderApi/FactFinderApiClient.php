<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Client\FactFinderApi;

use Generated\Shared\Transfer\FactFinderApiRecommendationRequestTransfer;
use Generated\Shared\Transfer\FactFinderApiSearchRequestTransfer;
use Generated\Shared\Transfer\FactFinderApiSuggestRequestTransfer;
use Generated\Shared\Transfer\FactFinderApiTrackingRequestTransfer;
use Spryker\Client\Kernel\AbstractClient;

/**
 * @method \SprykerEco\Client\FactFinderApi\FactFinderApiFactory getFactory()
 */
class FactFinderApiClient extends AbstractClient implements FactFinderApiClientInterface
{

    /**
     * @api
     *
     * @param \Generated\Shared\Transfer\FactFinderApiSearchRequestTransfer $factFinderSearchRequestTransfer
     *
     * @return \Generated\Shared\Transfer\FactFinderApiSearchResponseTransfer
     */
    public function search(FactFinderApiSearchRequestTransfer $factFinderSearchRequestTransfer)
    {
        $factFinderSearchResponseTransfer = $this
            ->getFactory()
            ->createSearchRequest()
            ->request($factFinderSearchRequestTransfer);

        return $factFinderSearchResponseTransfer;
    }

    /**
     * @api
     *
     * @param \Generated\Shared\Transfer\FactFinderApiTrackingRequestTransfer $factFinderTrackingRequestTransfer
     *
     * @return \Generated\Shared\Transfer\FactFinderApiTrackingResponseTransfer
     */
    public function track(FactFinderApiTrackingRequestTransfer $factFinderTrackingRequestTransfer)
    {
        $factFinderTrackingResponseTransfer = $this->getFactory()
            ->createTrackingRequest()
            ->request($factFinderTrackingRequestTransfer);

        return $factFinderTrackingResponseTransfer;
    }

    /**
     * @api
     *
     * @param \Generated\Shared\Transfer\FactFinderApiSuggestRequestTransfer $factFinderSuggestRequestTransfer
     *
     * @return \Generated\Shared\Transfer\FactFinderApiSuggestResponseTransfer
     */
    public function getSuggestions(FactFinderApiSuggestRequestTransfer $factFinderSuggestRequestTransfer)
    {
        $factFinderSuggestResponseTransfer = $this
            ->getFactory()
            ->createSuggestRequest()
            ->request($factFinderSuggestRequestTransfer);

        return $factFinderSuggestResponseTransfer;
    }

    /**
     * @api
     *
     * @param \Generated\Shared\Transfer\FactFinderApiRecommendationRequestTransfer $factFinderRecommendationRequestTransfer
     *
     * @return \Generated\Shared\Transfer\FactFinderApiRecommendationResponseTransfer
     */
    public function getRecommendations(FactFinderApiRecommendationRequestTransfer $factFinderRecommendationRequestTransfer)
    {
        $factFinderRecommendationResponseTransfer = $this
            ->getFactory()
            ->createRecommendationsRequest()
            ->request($factFinderRecommendationRequestTransfer);

        return $factFinderRecommendationResponseTransfer;
    }

    /**
     * @api
     *
     * @return \Spryker\Client\Session\SessionClientInterface
     */
    public function getSession()
    {
        return $this->getFactory()
            ->getSession();
    }

}
