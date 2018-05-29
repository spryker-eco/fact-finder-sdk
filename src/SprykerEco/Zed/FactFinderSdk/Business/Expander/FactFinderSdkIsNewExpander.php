<?php

namespace SprykerEco\Zed\FactFinderSdk\Business\Expander;

use Generated\Shared\Transfer\LocaleTransfer;
use SprykerEco\Shared\FactFinderSdk\FactFinderSdkConstants;

class FactFinderSdkIsNewExpander extends FactFinderSdkAbstractExpander
{
    const NEW_FROM = 'NewFrom';
    const NEW_TO = 'NewTo';

    /**
     * @param LocaleTransfer $localeTransfer
     * @param $productData
     * @return array
     */
    public function expand(LocaleTransfer $localeTransfer, $productData)
    {
        $newFrom = strtotime($productData[static::NEW_FROM]);
        $newTo = strtotime($productData[static::NEW_TO]);

        $productData[FactFinderSdkConstants::ITEM_IS_NEW] = (int) $this->isNew($newFrom, $newTo);

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