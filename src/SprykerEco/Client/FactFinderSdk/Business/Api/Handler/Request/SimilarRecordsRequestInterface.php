<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Client\FactFinderSdk\Business\Api\Handler\Request;

use Generated\Shared\Transfer\FactFinderSdkSimilarRecordsRequestTransfer;

interface SimilarRecordsRequestInterface
{

    /**
     * @param \Generated\Shared\Transfer\FactFinderSdkSimilarRecordsRequestTransfer $factFinderSimilarRecordsRequestTransfer
     *
     * @return \Generated\Shared\Transfer\FactFinderSdkSimilarRecordsResponseTransfer
     */
    public function request(FactFinderSdkSimilarRecordsRequestTransfer $factFinderSimilarRecordsRequestTransfer);

}
