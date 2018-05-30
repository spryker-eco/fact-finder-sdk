<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */
namespace SprykerEco\Zed\FactFinderSdk\Business\Expander;

use Generated\Shared\Transfer\LocaleTransfer;

interface FactFinderSdkExpanderInterface
{
    /**
     * @param \Generated\Shared\Transfer\LocaleTransfer $localeTransfer
     * @param array $productData
     *
     * @return array
     */
    public function expand(LocaleTransfer $localeTransfer, $productData);
}
