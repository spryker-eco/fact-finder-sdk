<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Client\FactFinderSdk\Business\Api\Converter;

use FACTFinder\Adapter\Recommendation as FactFinderRecommendationAdapter;
use FACTFinder\Data\Record;
use Generated\Shared\Transfer\FactFinderSdkRecommendationResponseTransfer;
use SprykerEco\Shared\FactFinderSdk\FactFinderSdkConstants;

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
     * @return \Generated\Shared\Transfer\FactFinderSdkRecommendationResponseTransfer
     */
    public function convert()
    {
        $responseTransfer = new FactFinderSdkRecommendationResponseTransfer();

        $recommendations = $this->recommendationAdapter
            ->getRecommendations();

        foreach ($recommendations as $recommendation) {
            $recommendationData = $this->getRecommendationData($recommendation);
            $responseTransfer->addRecommendations($recommendationData);
        }

        return $responseTransfer;
    }

    /**
     * @param \FACTFinder\Data\Record $recommendation
     *
     * @return array
     */
    protected function getRecommendationData(Record $recommendation)
    {
        $result = [];

        $result['position'] = $recommendation->getPosition();
        $result['seoPath'] = $recommendation->getSeoPath();
        $result['keywords'] = $recommendation->getKeywords();
        $result['similarity'] = $recommendation->getSimilarity();
        $result['id'] = $recommendation->getId();
        $result['fields'] = $this->getFields($recommendation);

        return $result;
    }

    /**
     * @param \FACTFinder\Data\Record $recommendation
     *
     * @return array
     */
    protected function getFields(Record $recommendation)
    {
        $fields = [];

        foreach (FactFinderSdkConstants::ITEM_FIELDS as $fieldName) {
            $fields[$fieldName] = $recommendation->getField($fieldName);
        }

        return $fields;
    }

}
