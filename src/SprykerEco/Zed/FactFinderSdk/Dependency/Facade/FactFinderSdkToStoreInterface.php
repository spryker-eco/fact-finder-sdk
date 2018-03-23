<?php

namespace SprykerEco\Zed\FactFinderSdk\Dependency\Facade;

interface FactFinderSdkToStoreInterface
{
    /**
     * Specification:
     *  - Returns currently selected store transfer
     *
     * @api
     *
     * @return \Generated\Shared\Transfer\StoreTransfer
     */
    public function getCurrentStore();
}
