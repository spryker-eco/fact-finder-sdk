<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Client\FactFinderSdk\Business\Api\Handler\Request;

use Generated\Shared\Transfer\FactFinderSdkSimilarRecordsRequestTransfer;
use SprykerEco\Client\FactFinderSdk\Business\Api\ApiConstants;

class SimilarRecordsRequest extends AbstractRequest implements SimilarRecordsRequestInterface
{
    const TRANSACTION_TYPE = ApiConstants::TRANSACTION_TYPE_SIMILAR_RECORDS;

    /**
     * @param \Generated\Shared\Transfer\FactFinderSdkSimilarRecordsRequestTransfer $factFinderSimilarRecordsRequestTransfer
     *
     * @return \Generated\Shared\Transfer\FactFinderSdkSimilarRecordsResponseTransfer
     */
    public function request(FactFinderSdkSimilarRecordsRequestTransfer $factFinderSimilarRecordsRequestTransfer)
    {
        $similarRecordsAdapter = $this->factFinderConnector->createSimilarRecordsAdapter();

        // convert to FFSearchResponseTransfer
        $responseTransfer = $this->converterFactory
            ->createSimilarRecordsResponseConverter($similarRecordsAdapter)
            ->convert();

        return $responseTransfer;
    }
}
