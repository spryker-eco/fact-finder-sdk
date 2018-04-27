<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\FactFinderSdk\Dependency\Facade;

interface FactFinderSdkToCurrencyInterface
{
    /**
     * Specification:
     *  - Returns default currency for current store
     *
     * @api
     *
     * @return \Generated\Shared\Transfer\CurrencyTransfer
     */
    public function getDefaultCurrencyForCurrentStore();
}
