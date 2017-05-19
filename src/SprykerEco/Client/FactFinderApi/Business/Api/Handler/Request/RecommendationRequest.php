<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Client\FactFinderApi\Business\Api\Handler\Request;

use FACTFinder\Util\Parameters;
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
        $requestParameters = new Parameters();
        $requestParameters->setAll($factFinderRecommendationRequestTransfer->toArray());
        $this->factFinderConnector->setRequestParameters($requestParameters);

        $recommendationAdapter = $this->factFinderConnector
            ->createRecommendationAdapter();

        $responseTransfer = $this->converterFactory
            ->createRecommendationResponseConverter($recommendationAdapter)
            ->convert();

        return $responseTransfer;
    }

}
