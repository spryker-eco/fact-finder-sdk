<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */
namespace SprykerEco\Zed\FactFinderSdk\Business\Expander;

use Generated\Shared\Transfer\LocaleTransfer;
use SprykerEco\Shared\FactFinderSdk\FactFinderSdkConstants;

class FactFinderSdkUrlExpander extends FactFinderSdkAbstractExpander
{
    /**
     * @param \Generated\Shared\Transfer\LocaleTransfer $localeTransfer
     * @param array $productData
     *
     * @return array
     */
    public function expand(LocaleTransfer $localeTransfer, $productData)
    {
        $productUrl = 'http://' . $this->config
                ->getYvesHost() . $productData[FactFinderSdkConstants::ITEM_PRODUCT_URL];
        $concreteAttributes = json_decode($productData[FactFinderSdkConstants::ITEM_CONCRETE_PRODUCT_ATTRIBUTES], true);

        $productUrl = $this->addAttributes($productUrl, $concreteAttributes);
        $productData[FactFinderSdkConstants::ITEM_PRODUCT_URL] = $productUrl;

        return $productData;
    }

    /**
     * @param string $productUrl
     * @param array $concreteAttributes
     *
     * @return string
     */
    protected function addAttributes($productUrl, $concreteAttributes)
    {
        if (empty($concreteAttributes)) {
            return $productUrl;
        }
        $productUrl .= '?';

        foreach ($concreteAttributes as $attribute => $value) {
            $value = urlencode($value);
            $productUrl .= "attribute[$attribute]=$value&";
        }

        return $productUrl;
    }
}
