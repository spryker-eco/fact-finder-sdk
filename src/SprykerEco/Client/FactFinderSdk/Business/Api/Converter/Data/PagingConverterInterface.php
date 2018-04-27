<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Client\FactFinderSdk\Business\Api\Converter\Data;

use FACTFinder\Data\Paging;

interface PagingConverterInterface
{
    /**
     * @param \FACTFinder\Data\Paging $paging
     *
     * @return void
     */
    public function setPaging(Paging $paging);

    /**
     * @return \Generated\Shared\Transfer\FactFinderSdkDataPagingTransfer
     */
    public function convert();
}
