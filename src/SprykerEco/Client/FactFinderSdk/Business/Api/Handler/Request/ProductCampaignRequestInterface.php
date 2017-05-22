<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Client\FactFinderSdk\Business\Api\Handler\Request;

use Generated\Shared\Transfer\FactFinderSdkProductCampaignRequestTransfer;

interface ProductCampaignRequestInterface
{

    /**
     * @param \Generated\Shared\Transfer\FactFinderSdkProductCampaignRequestTransfer $factFinderProductCampaignRequestTransfer
     *
     * @return \Generated\Shared\Transfer\FactFinderSdkProductCampaignResponseTransfer
     */
    public function request(FactFinderSdkProductCampaignRequestTransfer $factFinderProductCampaignRequestTransfer);

}
