<?php

namespace SprykerEco\Zed\FactFinderSdk\Business\Expander;

use Generated\Shared\Transfer\LocaleTransfer;
use SprykerEco\Shared\FactFinderSdk\FactFinderSdkConstants;

class FactFinderSdkDescriptionExpander extends FactFinderSdkAbstractExpander
{

    /**
     * @param LocaleTransfer $localeTransfer
     * @param $productData
     * @return array
     */
    public function expand(LocaleTransfer $localeTransfer, $productData)
    {
        $data[FactFinderSdkConstants::ITEM_DESCRIPTION] = quotemeta($productData[FactFinderSdkConstants::ITEM_DESCRIPTION]);

        return $productData;
    }

}