<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Client\FactFinderApi\Business\Api\Handler\Request;

use Generated\Shared\Transfer\FactFinderApiTrackingRequestTransfer;

interface TrackingRequestInterface
{

    /**
     * @param \Generated\Shared\Transfer\FactFinderApiTrackingRequestTransfer $factFinderTrackingRequestTransfer
     *
     * @return \Generated\Shared\Transfer\FactFinderApiTrackingResponseTransfer
     */
    public function request(FactFinderApiTrackingRequestTransfer $factFinderTrackingRequestTransfer);

}
