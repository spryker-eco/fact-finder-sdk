<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\FactFinderSdk\Dependency\Facade;

/**
 * @SuppressWarnings(BridgeNameRule)
 */
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
