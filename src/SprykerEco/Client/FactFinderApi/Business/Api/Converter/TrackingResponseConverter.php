<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Client\FactFinderApi\Business\Api\Converter;

use FACTFinder\Adapter\Tracking as FactFinderTrackingAdapter;
use Generated\Shared\Transfer\FactFinderApiTrackingResponseTransfer;

class TrackingResponseConverter extends BaseConverter
{

    /**
     * @var \FACTFinder\Adapter\Tracking
     */
    protected $trackingAdapter;

    /**
     * @param \FACTFinder\Adapter\Tracking $trackingAdapter
     */
    public function __construct(FactFinderTrackingAdapter $trackingAdapter)
    {
        $this->trackingAdapter = $trackingAdapter;
    }

    /**
     * @return \Generated\Shared\Transfer\FactFinderApiTrackingResponseTransfer
     */
    public function convert()
    {
        $responseTransfer = new FactFinderApiTrackingResponseTransfer();

        return $responseTransfer;
    }

}
