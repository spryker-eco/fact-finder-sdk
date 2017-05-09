<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Client\FactFinder\Business\Api\Handler\Request;

use Generated\Shared\Transfer\FactFinderTrackingRequestTransfer;

interface TrackingRequestInterface
{

    /**
     * @param \Generated\Shared\Transfer\FactFinderTrackingRequestTransfer $factFinderTrackingRequestTransfer
     *
     * @return \Generated\Shared\Transfer\FactFinderTrackingResponseTransfer
     */
    public function request(FactFinderTrackingRequestTransfer $factFinderTrackingRequestTransfer);

}
