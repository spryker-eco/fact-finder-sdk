<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Client\FactFinder\Business\Api\Handler\Request;

use Generated\Shared\Transfer\FactFinderTagCloudRequestTransfer;

interface TagCloudRequestInterface
{

    /**
     * @param \Generated\Shared\Transfer\FactFinderTagCloudRequestTransfer $factFinderTagCloudRequestTransfer
     *
     * @return \Generated\Shared\Transfer\FactFinderTagCloudResponseTransfer
     */
    public function request(FactFinderTagCloudRequestTransfer $factFinderTagCloudRequestTransfer);

}
