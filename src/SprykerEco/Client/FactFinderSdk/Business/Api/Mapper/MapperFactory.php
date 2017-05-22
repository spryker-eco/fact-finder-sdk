<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Client\FactFinderSdk\Business\Api\Mapper;

use Generated\Shared\Transfer\FactFinderSdkSearchRequestTransfer;

class MapperFactory
{

    /**
     * @var \Generated\Shared\Transfer\FactFinderSdkSearchRequestTransfer
     */
    protected $requestTransfer;

    /**
     * @param \Generated\Shared\Transfer\FactFinderSdkSearchRequestTransfer $requestTransfer
     */
    public function __construct(FactFinderSdkSearchRequestTransfer $requestTransfer)
    {
        $this->requestTransfer = $requestTransfer;
    }

}
