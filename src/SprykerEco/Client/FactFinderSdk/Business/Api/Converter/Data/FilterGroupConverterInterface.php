<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Client\FactFinderSdk\Business\Api\Converter\Data;

use FACTFinder\Data\FilterGroup;

interface FilterGroupConverterInterface
{
    /**
     * @param \FACTFinder\Data\FilterGroup $filterGroup
     *
     * @return void
     */
    public function setFilterGroup(FilterGroup $filterGroup);

    /**
     * @return \Generated\Shared\Transfer\FactFinderSdkDataFilterGroupTransfer
     */
    public function convert();
}
