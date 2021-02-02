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

class FactFinderSdkIsNewExpander extends FactFinderSdkAbstractExpander
{
    public const NEW_FROM = 'NewFrom';
    public const NEW_TO = 'NewTo';

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
        $newFrom = strtotime($productData[static::NEW_FROM]);
        $newTo = strtotime($productData[static::NEW_TO]);

        $productData[FactFinderSdkConstants::ITEM_IS_NEW] = (int)$this->isNew($newFrom, $newTo);

        return $productData;
    }

    /**
     * @param int $newFrom
     * @param int $newTo
     *
     * @return bool
     */
    protected function isNew($newFrom, $newTo)
    {
        if ($newFrom > time()) {
            return false;
        }

        if ($newTo < time()) {
            return false;
        }

        return true;
    }
}
