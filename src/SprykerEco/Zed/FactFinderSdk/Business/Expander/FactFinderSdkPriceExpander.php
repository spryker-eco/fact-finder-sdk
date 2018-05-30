<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */
namespace SprykerEco\Zed\FactFinderSdk\Business\Expander;

use Generated\Shared\Transfer\LocaleTransfer;
use SprykerEco\Shared\FactFinderSdk\FactFinderSdkConstants;

class FactFinderSdkPriceExpander extends FactFinderSdkAbstractExpander
{
    /**
     * @param \Generated\Shared\Transfer\LocaleTransfer $localeTransfer
     * @param array $productData
     *
     * @return array
     */
    public function expand(LocaleTransfer $localeTransfer, $productData)
    {
        $price = number_format($productData[FactFinderSdkConstants::ITEM_PRICE] / 100, 2, '.', '');
        $productData[FactFinderSdkConstants::ITEM_PRICE] = $price;

        return $productData;
    }
}
