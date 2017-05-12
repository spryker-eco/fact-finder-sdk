<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\FactFinderApi\Dependency\Facade;

interface FactFinderApiToMoneyInterface
{

    /**
     * @param int $value
     *
     * @return float
     */
    public function convertIntegerToDecimal($value);

}
