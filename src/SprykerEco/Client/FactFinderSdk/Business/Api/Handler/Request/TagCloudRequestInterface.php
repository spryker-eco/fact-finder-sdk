<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Client\FactFinderSdk\Business\Api\Handler\Request;

use Generated\Shared\Transfer\FactFinderSdkTagCloudRequestTransfer;

interface TagCloudRequestInterface
{
    /**
     * @param \Generated\Shared\Transfer\FactFinderSdkTagCloudRequestTransfer $factFinderTagCloudRequestTransfer
     *
     * @return \Generated\Shared\Transfer\FactFinderSdkTagCloudResponseTransfer
     */
    public function request(FactFinderSdkTagCloudRequestTransfer $factFinderTagCloudRequestTransfer);
}
