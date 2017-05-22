<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Client\FactFinderSdk\Business\Api\Converter;

use FACTFinder\Adapter\ProductCampaign as FactFinderProductCampaign;
use Generated\Shared\Transfer\FactFinderSdkProductCampaignResponseTransfer;

class ProductCampaignResponseConverter extends BaseConverter
{

    /**
     * @var \FACTFinder\Adapter\ProductCampaign
     */
    protected $productCampaignAdapter;

    /**
     * @param \FACTFinder\Adapter\ProductCampaign $productCampaignAdapter
     */
    public function __construct(FactFinderProductCampaign $productCampaignAdapter)
    {
        $this->productCampaignAdapter = $productCampaignAdapter;
    }

    /**
     * @return \Generated\Shared\Transfer\FactFinderSdkProductCampaignResponseTransfer
     */
    public function convert()
    {
        $responseTransfer = new FactFinderSdkProductCampaignResponseTransfer();

        return $responseTransfer;
    }

}
