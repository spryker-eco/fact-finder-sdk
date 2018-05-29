<?php

namespace SprykerEco\Zed\FactFinderSdk\Business\Expander;

use Generated\Shared\Transfer\LocaleTransfer;
use SprykerEco\Shared\FactFinderSdk\FactFinderSdkConstants;

class FactFinderSdkUrlExpander extends FactFinderSdkAbstractExpander
{

    /**
     * @param LocaleTransfer $localeTransfer
     * @param $productData
     * @return array
     */
    public function expand(LocaleTransfer $localeTransfer, $productData)
    {
        $productUrl = 'http://' . $this->config
                ->getYvesHost() . $productData[FactFinderSdkConstants::ITEM_PRODUCT_URL];
        $productData[FactFinderSdkConstants::ITEM_PRODUCT_URL] = $productUrl;

        return $productData;
    }

}