<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\FactFinderApi\Dependency\Facade;

class FactFinderApiToMoneyBridge implements FactFinderApiToMoneyInterface
{

    /**
     * @var \Spryker\Zed\Money\Business\MoneyFacadeInterface
     */
    protected $money;

    /**
     * FactFinderToMoneyBridge constructor.
     *
     * @param \Spryker\Zed\Money\Business\MoneyFacadeInterface $money
     */
    public function __construct($money)
    {
        $this->money = $money;
    }

    /**
     * @param int $value
     *
     * @return float
     */
    public function convertIntegerToDecimal($value)
    {
        return $this->money
            ->convertIntegerToDecimal($value);
    }

}
