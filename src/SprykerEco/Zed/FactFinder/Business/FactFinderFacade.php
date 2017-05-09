<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\FactFinder\Business;

use Generated\Shared\Transfer\LocaleTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \SprykerEco\Zed\FactFinder\Business\FactFinderBusinessFactory getFactory()
 */
class FactFinderFacade extends AbstractFacade implements FactFinderFacadeInterface
{

    /**
     * @api
     *
     * @param \Generated\Shared\Transfer\LocaleTransfer $localeTransfer
     *
     * @return mixed
     */
    public function createFactFinderCsv(LocaleTransfer $localeTransfer)
    {
        $this->getFactory()
            ->createCsvFile($localeTransfer);
    }

}
