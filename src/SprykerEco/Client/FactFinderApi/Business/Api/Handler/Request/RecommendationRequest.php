<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Client\FactFinderApi\Business\Api\Handler\Request;

use Generated\Shared\Transfer\FactFinderApiRecommendationRequestTransfer;
use SprykerEco\Client\FactFinderApi\Business\Api\ApiConstants;

class RecommendationRequest extends AbstractRequest implements RecommendationRequestInterface
{

    const TRANSACTION_TYPE = ApiConstants::TRANSACTION_TYPE_RECOMMENDATION;

    /**
     * @param \Generated\Shared\Transfer\FactFinderApiRecommendationRequestTransfer $factFinderRecommendationRequestTransfer
     *
     * @return \Generated\Shared\Transfer\FactFinderApiRecommendationResponseTransfer
     */
    public function request(FactFinderApiRecommendationRequestTransfer $factFinderRecommendationRequestTransfer)
    {
        $requestParameters = $this->factFinderConnector->createRequestParametersFromRequestParser();
        $this->factFinderConnector->setRequestParameters($requestParameters);

        $suggestAdapter = $this->factFinderConnector
            ->createRecommendationAdapter();

        $recommendations = $suggestAdapter->getRecommendations();

        $responseTransfer = $this->converterFactory
            ->createRecommendationResponseConverter($suggestAdapter)
            ->convert();

        return $responseTransfer;
    }

}
