<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\FactFinderApi\Business;

use Generated\Shared\Transfer\LocaleTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \SprykerEco\Zed\FactFinderApi\Business\FactFinderApiBusinessFactory getFactory()
 */
class FactFinderApiFacade extends AbstractFacade implements FactFinderApiFacadeInterface
{

    /**
     * @api
     *
     * @param \Generated\Shared\Transfer\LocaleTransfer $localeTransfer
     *
     * @return mixed
     */
    public function createFactFinderApiCsv(LocaleTransfer $localeTransfer)
    {
        $this->getFactory()
            ->createCsvFile($localeTransfer);
    }

}
