<?php

namespace SprykerEco\Zed\FactFinderSdk\Business\Expander;

use Generated\Shared\Transfer\LocaleTransfer;
use SprykerEco\Shared\FactFinderSdk\FactFinderSdkConstants;

class FactFinderSdkTimestampExpander extends FactFinderSdkAbstractExpander
{
    const CREATED_AT = 'CreatedAt';

    /**
     * @param LocaleTransfer $localeTransfer
     * @param $productData
     * @return array
     */
    public function expand(LocaleTransfer $localeTransfer, $productData)
    {
        $productData[FactFinderSdkConstants::ITEM_CREATED_AT] = strtotime($productData[static::CREATED_AT]);

        return $productData;
    }

}