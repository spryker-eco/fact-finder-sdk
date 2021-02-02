<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\FactFinderSdk\Business\Expander;

use Generated\Shared\Transfer\CurrencyTransfer;
use Generated\Shared\Transfer\LocaleTransfer;
use Generated\Shared\Transfer\StoreTransfer;
use Orm\Zed\PriceProduct\Persistence\Base\SpyPriceProduct;
use SprykerEco\Shared\FactFinderSdk\FactFinderSdkConstants;

class FactFinderSdkPriceExpander extends FactFinderSdkAbstractExpander
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
        $priceProductQuery = $this->queryContainer
            ->getPricesQuery($productData[FactFinderSdkConstants::ITEM_PRODUCT_NUMBER], $currencyTransfer, $storeTransfer);
        $price = $priceProductQuery->findOne();

        if ($price !== null) {
            return $this->addPrice($productData, $price);
        }

        $priceProductQuery = $this->queryContainer
            ->getProductAbstractPriceQuery($productData[FactFinderSdkConstants::ITEM_PRODUCT_NUMBER], $currencyTransfer, $storeTransfer);
        $price = $priceProductQuery->findOne();

        if ($price !== null) {
            return $this->addPrice($productData, $price);
        }

        return $productData;
    }

    /**
     * @param \Orm\Zed\PriceProduct\Persistence\Base\SpyPriceProduct $price
     *
     * @return string
     */
    protected function getPrice(SpyPriceProduct $price)
    {
        $priceValue = $price->getVirtualColumn(FactFinderSdkConstants::ITEM_PRICE);

        return number_format($priceValue / 100, 2, '.', '');
    }

    /**
     * @param array $productData
     * @param \Orm\Zed\PriceProduct\Persistence\Base\SpyPriceProduct $price
     *
     * @return array
     */
    protected function addPrice($productData, SpyPriceProduct $price)
    {
        $productData[FactFinderSdkConstants::ITEM_PRICE] = $this->getPrice($price);

        return $productData;
    }
}
