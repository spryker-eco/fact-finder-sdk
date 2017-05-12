<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Client\FactFinderApi\Business\Api\Handler\Request;

use Generated\Shared\Transfer\FactFinderApiTagCloudRequestTransfer;

interface TagCloudRequestInterface
{

    /**
     * @param \Generated\Shared\Transfer\FactFinderApiTagCloudRequestTransfer $factFinderTagCloudRequestTransfer
     *
     * @return \Generated\Shared\Transfer\FactFinderApiTagCloudResponseTransfer
     */
    public function request(FactFinderApiTagCloudRequestTransfer $factFinderTagCloudRequestTransfer);

}
