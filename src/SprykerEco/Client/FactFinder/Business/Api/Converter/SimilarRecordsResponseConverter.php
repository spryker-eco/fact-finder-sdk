<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Client\FactFinder\Business\Api\Converter;

use FACTFinder\Adapter\SimilarRecords as FactFinderSimilarRecords;
use Generated\Shared\Transfer\FactFinderSimilarRecordsResponseTransfer;

class SimilarRecordsResponseConverter extends BaseConverter
{

    /**
     * @var \FACTFinder\Adapter\SimilarRecords
     */
    protected $similarRecordsAdapter;

    /**
     * @param \FACTFinder\Adapter\SimilarRecords $similarRecordsAdapter
     */
    public function __construct(FactFinderSimilarRecords $similarRecordsAdapter)
    {
        $this->similarRecordsAdapter = $similarRecordsAdapter;
    }

    /**
     * @return \Generated\Shared\Transfer\FactFinderSimilarRecordsResponseTransfer
     */
    public function convert()
    {
        $responseTransfer = new FactFinderSimilarRecordsResponseTransfer();

        return $responseTransfer;
    }

}
