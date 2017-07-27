<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Client\FactFinderSdk\Business\Api\Handler\Request;

use Generated\Shared\Transfer\FactFinderSdkProductCampaignRequestTransfer;
use SprykerEco\Client\FactFinderSdk\Business\Api\ApiConstants;

class ProductCampaignRequest extends AbstractRequest implements ProductCampaignRequestInterface
{

    const TRANSACTION_TYPE = ApiConstants::TRANSACTION_TYPE_PRODUCT_CAMPAIGN;

    /**
     * @param \Generated\Shared\Transfer\FactFinderSdkProductCampaignRequestTransfer $factFinderProductCampaignRequestTransfer
     *
     * @return \Generated\Shared\Transfer\FactFinderSdkProductCampaignResponseTransfer
     */
    public function request(FactFinderSdkProductCampaignRequestTransfer $factFinderProductCampaignRequestTransfer)
    {
        $requestParameters = $this->factFinderConnector
            ->createRequestParametersFromProductCampaignRequestTransfer($factFinderProductCampaignRequestTransfer);
        $this->factFinderConnector->setRequestParameters($requestParameters);

        $productCampaignAdapter = $this->factFinderConnector
            ->createProductCampaignAdapter();

        $responseTransfer = $this->converterFactory
            ->createProductCampaignResponseConverter($productCampaignAdapter)
            ->convert();

        return $responseTransfer;
    }

}
