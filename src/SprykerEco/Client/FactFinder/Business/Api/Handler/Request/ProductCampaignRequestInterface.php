<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Client\FactFinder\Business\Api\Handler\Request;

use Generated\Shared\Transfer\FactFinderProductCampaignRequestTransfer;

interface ProductCampaignRequestInterface
{

    /**
     * @param \Generated\Shared\Transfer\FactFinderProductCampaignRequestTransfer $factFinderProductCampaignRequestTransfer
     *
     * @return \Generated\Shared\Transfer\FactFinderProductCampaignResponseTransfer
     */
    public function request(FactFinderProductCampaignRequestTransfer $factFinderProductCampaignRequestTransfer);

}
