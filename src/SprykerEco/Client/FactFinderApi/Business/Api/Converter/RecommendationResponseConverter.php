<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Client\FactFinderApi\Business\Api\Converter;

use FACTFinder\Adapter\Recommendation as FactFinderRecommendationAdapter;
use Generated\Shared\Transfer\FactFinderApiRecommendationResponseTransfer;

class RecommendationResponseConverter extends BaseConverter
{

    /**
     * @var \FACTFinder\Adapter\Recommendation
     */
    protected $recommendationAdapter;

    /**
     * @param \FACTFinder\Adapter\Recommendation $recommendationAdapter
     */
    public function __construct(FactFinderRecommendationAdapter $recommendationAdapter)
    {
        $this->recommendationAdapter = $recommendationAdapter;
    }

    /**
     * @return \Generated\Shared\Transfer\FactFinderApiRecommendationResponseTransfer
     */
    public function convert()
    {
        $responseTransfer = new FactFinderApiRecommendationResponseTransfer();

        return $responseTransfer;
    }

}
