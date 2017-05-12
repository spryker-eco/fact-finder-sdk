<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Client\FactFinderApi\Business\Api\Handler\Request;

use Generated\Shared\Transfer\FactFinderApiRecommendationRequestTransfer;

interface RecommendationRequestInterface
{

    /**
     * @param \Generated\Shared\Transfer\FactFinderApiRecommendationRequestTransfer $factFinderRecommendationRequestTransfer
     *
     * @return \Generated\Shared\Transfer\FactFinderApiRecommendationResponseTransfer
     */
    public function request(FactFinderApiRecommendationRequestTransfer $factFinderRecommendationRequestTransfer);

}
