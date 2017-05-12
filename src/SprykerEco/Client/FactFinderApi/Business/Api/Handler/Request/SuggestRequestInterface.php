<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Client\FactFinderApi\Business\Api\Handler\Request;

use Generated\Shared\Transfer\FactFinderApiSuggestRequestTransfer;

interface SuggestRequestInterface
{

    /**
     * @param \Generated\Shared\Transfer\FactFinderApiSuggestRequestTransfer $factFinderSuggestRequestTransfer
     *
     * @return \Generated\Shared\Transfer\FactFinderApiSuggestResponseTransfer
     */
    public function request(FactFinderApiSuggestRequestTransfer $factFinderSuggestRequestTransfer);

}
