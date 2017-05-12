<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Client\FactFinderApi\Business\Api\Mapper;

use Generated\Shared\Transfer\FactFinderApiSearchRequestTransfer;

class MapperFactory
{

    /**
     * @var \Generated\Shared\Transfer\FactFinderApiSearchRequestTransfer
     */
    protected $requestTransfer;

    /**
     * @param \Generated\Shared\Transfer\FactFinderApiSearchRequestTransfer $requestTransfer
     */
    public function __construct(FactFinderApiSearchRequestTransfer $requestTransfer)
    {
        $this->requestTransfer = $requestTransfer;
    }

}
