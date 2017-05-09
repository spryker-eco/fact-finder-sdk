<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Client\FactFinder\Business\Api\Handler\Request;

use Generated\Shared\Transfer\FactFinderSimilarRecordsRequestTransfer;
use SprykerEco\Client\FactFinder\Business\Api\ApiConstants;

class SimilarRecordsRequest extends AbstractRequest implements SimilarRecordsRequestInterface
{

    const TRANSACTION_TYPE = ApiConstants::TRANSACTION_TYPE_SIMILAR_RECORDS;

    /**
     * @param \Generated\Shared\Transfer\FactFinderSimilarRecordsRequestTransfer $factFinderSimilarRecordsRequestTransfer
     *
     * @return \Generated\Shared\Transfer\FactFinderSimilarRecordsResponseTransfer
     */
    public function request(FactFinderSimilarRecordsRequestTransfer $factFinderSimilarRecordsRequestTransfer)
    {
        $similarRecordsAdapter = $this->factFinderConnector->createSimilarRecordsAdapter();

        // convert to FFSearchResponseTransfer
        $responseTransfer = $this->converterFactory
            ->createSimilarRecordsResponseConverter($similarRecordsAdapter)
            ->convert();

        return $responseTransfer;
    }

}
