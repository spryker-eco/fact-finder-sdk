<?php

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
