<?php

namespace SprykerEco\Zed\FactFinderSdk\Business\Expander;

use Generated\Shared\Transfer\LocaleTransfer;
use SprykerEco\Shared\FactFinderSdk\FactFinderSdkConstants;

class FactFinderSdkAttributesExpander extends FactFinderSdkAbstractExpander
{

    /**
     * @param LocaleTransfer $localeTransfer
     * @param $productData
     * @return array
     */
    public function expand(LocaleTransfer $localeTransfer, $productData)
    {
        $abstractProductAttributes = json_decode($productData[FactFinderSdkConstants::ITEM_ABSTRACT_PRODUCT_ATTRIBUTES], true);
        $concreteProductAttributes = json_decode($productData[FactFinderSdkConstants::ITEM_CONCRETE_PRODUCT_ATTRIBUTES], true);

        $attributes = array_merge($abstractProductAttributes, $concreteProductAttributes);

        $productData[FactFinderSdkConstants::ITEM_ATTRIBUTES] = $this->formatAttributes($attributes);

        return $productData;
    }

    /**
     * @param array $attributes
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