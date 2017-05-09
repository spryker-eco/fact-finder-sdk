<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Client\FactFinder\Business\Api\Handler\Request;

use Generated\Shared\Transfer\FactFinderSimilarRecordsRequestTransfer;

interface SimilarRecordsRequestInterface
{

    /**
     * @param \Generated\Shared\Transfer\FactFinderSimilarRecordsRequestTransfer $factFinderSimilarRecordsRequestTransfer
     *
     * @return \Generated\Shared\Transfer\FactFinderSimilarRecordsResponseTransfer
     */
    public function request(FactFinderSimilarRecordsRequestTransfer $factFinderSimilarRecordsRequestTransfer);

}
