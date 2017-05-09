<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Client\FactFinder\Business\Api\Handler\Request;

use Generated\Shared\Transfer\FactFinderProductCampaignRequestTransfer;
use SprykerEco\Client\FactFinder\Business\Api\ApiConstants;

class ProductCampaignRequest extends AbstractRequest implements ProductCampaignRequestInterface
{

    const TRANSACTION_TYPE = ApiConstants::TRANSACTION_TYPE_PRODUCT_CAMPAIGN;

    /**
     * @param \Generated\Shared\Transfer\FactFinderProductCampaignRequestTransfer $factFinderProductCampaignRequestTransfer
     *
     * @return \Generated\Shared\Transfer\FactFinderProductCampaignResponseTransfer
     */
    public function request(FactFinderProductCampaignRequestTransfer $factFinderProductCampaignRequestTransfer)
    {
        $productCampaignAdapter = $this->factFinderConnector
            ->createProductCampaignAdapter();

        $responseTransfer = $this->converterFactory
            ->createProductCampaignResponseConverter($productCampaignAdapter)
            ->convert();

        return $responseTransfer;
    }

}
