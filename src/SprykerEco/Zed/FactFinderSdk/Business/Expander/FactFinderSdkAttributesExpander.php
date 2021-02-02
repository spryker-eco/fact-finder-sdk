<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\FactFinderSdk\Business\Expander;

use Generated\Shared\Transfer\CurrencyTransfer;
use Generated\Shared\Transfer\LocaleTransfer;
use Generated\Shared\Transfer\StoreTransfer;
use SprykerEco\Shared\FactFinderSdk\FactFinderSdkConstants;

class FactFinderSdkAttributesExpander extends FactFinderSdkAbstractExpander
{
    /**
     * @param \Generated\Shared\Transfer\LocaleTransfer $localeTransfer
     * @param \Generated\Shared\Transfer\CurrencyTransfer $currencyTransfer
     * @param \Generated\Shared\Transfer\StoreTransfer $storeTransfer
     * @param array $productData
     *
     * @return array
     */
    public function expand(LocaleTransfer $localeTransfer, CurrencyTransfer $currencyTransfer, StoreTransfer $storeTransfer, $productData)
    {
        $abstractProductAttributes = json_decode($productData[FactFinderSdkConstants::ITEM_ABSTRACT_PRODUCT_ATTRIBUTES], true);
        $concreteProductAttributes = json_decode($productData[FactFinderSdkConstants::ITEM_CONCRETE_PRODUCT_ATTRIBUTES], true);

        $attributes = array_merge($abstractProductAttributes, $concreteProductAttributes);

        $productData[FactFinderSdkConstants::ITEM_ATTRIBUTES] = $this->formatAttributes($attributes);

        return $productData;
    }

    /**
     * @param array $attributes
     *
     * @return string
     */
    protected function formatAttributes($attributes)
    {
        $resultString = '';

        foreach ($attributes as $name => $value) {
            $resultString .= quotemeta($name) . '=' . quotemeta($value) . '|';
        }

        return $resultString;
    }
}
