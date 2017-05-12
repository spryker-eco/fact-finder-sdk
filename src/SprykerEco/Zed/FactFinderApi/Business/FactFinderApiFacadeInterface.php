<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\FactFinderApi\Business;

use Generated\Shared\Transfer\LocaleTransfer;

interface FactFinderApiFacadeInterface
{

    /**
     * Specification:
     * - Creates a csv file
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\LocaleTransfer $localeTransferTransfer
     *
     * @return mixed
     */
    public function createFactFinderApiCsv(LocaleTransfer $localeTransferTransfer);

}
