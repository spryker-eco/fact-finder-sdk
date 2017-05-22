<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Client\FactFinderSdk\Business\Api\Handler\Request;

use Generated\Shared\Transfer\FactFinderSdkSuggestRequestTransfer;

interface SuggestRequestInterface
{

    /**
     * @param \Generated\Shared\Transfer\FactFinderSdkSuggestRequestTransfer $factFinderSuggestRequestTransfer
     *
     * @return \Generated\Shared\Transfer\FactFinderSdkSuggestResponseTransfer
     */
    public function request(FactFinderSdkSuggestRequestTransfer $factFinderSuggestRequestTransfer);

}
