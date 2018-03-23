<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Client\FactFinderSdk\Business\Api\Handler\Request;

class ShoppingCartCampaignRequest extends ProductCampaignRequest
{
    /**
     * @return \FACTFinder\Adapter\ProductCampaign
     */
    protected function prepareProductCampaignAdapter()
    {
        $productCampaignAdapter = $this->factFinderConnector
            ->createProductCampaignAdapter();

        $productCampaignAdapter->makeShoppingCartCampaign();

        return $productCampaignAdapter;
    }
}
