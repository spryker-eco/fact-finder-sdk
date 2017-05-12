<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Client\FactFinderApi\Business\Api\Handler\Request;

use Generated\Shared\Transfer\FactFinderApiProductCampaignRequestTransfer;
use SprykerEco\Client\FactFinderApi\Business\Api\ApiConstants;

class ProductCampaignRequest extends AbstractRequest implements ProductCampaignRequestInterface
{

    const TRANSACTION_TYPE = ApiConstants::TRANSACTION_TYPE_PRODUCT_CAMPAIGN;

    /**
     * @param \Generated\Shared\Transfer\FactFinderApiProductCampaignRequestTransfer $factFinderProductCampaignRequestTransfer
     *
     * @return \Generated\Shared\Transfer\FactFinderApiProductCampaignResponseTransfer
     */
    public function request(FactFinderApiProductCampaignRequestTransfer $factFinderProductCampaignRequestTransfer)
    {
        $productCampaignAdapter = $this->factFinderConnector
            ->createProductCampaignAdapter();

        $responseTransfer = $this->converterFactory
            ->createProductCampaignResponseConverter($productCampaignAdapter)
            ->convert();

        return $responseTransfer;
    }

}
