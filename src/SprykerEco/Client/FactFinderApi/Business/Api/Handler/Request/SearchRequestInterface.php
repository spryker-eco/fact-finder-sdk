<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Client\FactFinderApi\Business\Api\Handler\Request;

use Generated\Shared\Transfer\FactFinderApiSearchRequestTransfer;

interface SearchRequestInterface
{

    /**
     * @param \Generated\Shared\Transfer\FactFinderApiSearchRequestTransfer $factFinderSearchRequestTransfer
     *
     * @return \Generated\Shared\Transfer\FactFinderApiSearchResponseTransfer
     */
    public function request(FactFinderApiSearchRequestTransfer $factFinderSearchRequestTransfer);

}
