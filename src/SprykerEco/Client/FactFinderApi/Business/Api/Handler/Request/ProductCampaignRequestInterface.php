<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Client\FactFinderApi\Business\Api\Handler\Request;

use Generated\Shared\Transfer\FactFinderApiProductCampaignRequestTransfer;

interface ProductCampaignRequestInterface
{

    /**
     * @param \Generated\Shared\Transfer\FactFinderApiProductCampaignRequestTransfer $factFinderProductCampaignRequestTransfer
     *
     * @return \Generated\Shared\Transfer\FactFinderApiProductCampaignResponseTransfer
     */
    public function request(FactFinderApiProductCampaignRequestTransfer $factFinderProductCampaignRequestTransfer);

}
