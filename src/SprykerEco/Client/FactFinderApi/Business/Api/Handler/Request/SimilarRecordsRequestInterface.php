<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Client\FactFinderApi\Business\Api\Handler\Request;

use Generated\Shared\Transfer\FactFinderApiSimilarRecordsRequestTransfer;

interface SimilarRecordsRequestInterface
{

    /**
     * @param \Generated\Shared\Transfer\FactFinderApiSimilarRecordsRequestTransfer $factFinderSimilarRecordsRequestTransfer
     *
     * @return \Generated\Shared\Transfer\FactFinderApiSimilarRecordsResponseTransfer
     */
    public function request(FactFinderApiSimilarRecordsRequestTransfer $factFinderSimilarRecordsRequestTransfer);

}
