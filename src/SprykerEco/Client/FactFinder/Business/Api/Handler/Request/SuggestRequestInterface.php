<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Client\FactFinder\Business\Api\Handler\Request;

use Generated\Shared\Transfer\FactFinderSuggestRequestTransfer;

interface SuggestRequestInterface
{

    /**
     * @param \Generated\Shared\Transfer\FactFinderSuggestRequestTransfer $factFinderSuggestRequestTransfer
     *
     * @return \Generated\Shared\Transfer\FactFinderSuggestResponseTransfer
     */
    public function request(FactFinderSuggestRequestTransfer $factFinderSuggestRequestTransfer);

}
