<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\FactFinderSdk\Dependency\Facade;

class FactFinderSdkToMoneyBridge implements FactFinderSdkToMoneyInterface
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
