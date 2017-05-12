<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Client\FactFinderApi\Business\Api\Handler\Request;

use Generated\Shared\Transfer\FactFinderApiSimilarRecordsRequestTransfer;
use SprykerEco\Client\FactFinderApi\Business\Api\ApiConstants;

class SimilarRecordsRequest extends AbstractRequest implements SimilarRecordsRequestInterface
{

    const TRANSACTION_TYPE = ApiConstants::TRANSACTION_TYPE_SIMILAR_RECORDS;

    /**
     * @param \Generated\Shared\Transfer\FactFinderApiSimilarRecordsRequestTransfer $factFinderSimilarRecordsRequestTransfer
     *
     * @return \Generated\Shared\Transfer\FactFinderApiSimilarRecordsResponseTransfer
     */
    public function request(FactFinderApiSimilarRecordsRequestTransfer $factFinderSimilarRecordsRequestTransfer)
    {
        $similarRecordsAdapter = $this->factFinderConnector->createSimilarRecordsAdapter();

        // convert to FFSearchResponseTransfer
        $responseTransfer = $this->converterFactory
            ->createSimilarRecordsResponseConverter($similarRecordsAdapter)
            ->convert();

        return $responseTransfer;
    }

}
