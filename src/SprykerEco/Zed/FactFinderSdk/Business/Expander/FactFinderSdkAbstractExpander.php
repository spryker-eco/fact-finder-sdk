<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */
namespace SprykerEco\Zed\FactFinderSdk\Business\Expander;

use SprykerEco\Zed\FactFinderSdk\FactFinderSdkConfig;
use SprykerEco\Zed\FactFinderSdk\Persistence\FactFinderSdkQueryContainerInterface;

abstract class FactFinderSdkAbstractExpander implements FactFinderSdkExpanderInterface
{
    /**
     * @var \SprykerEco\Zed\FactFinderSdk\Persistence\FactFinderSdkQueryContainerInterface
     */
    protected $queryContainer;

    /**
     * @var \SprykerEco\Zed\FactFinderSdk\FactFinderSdkConfig
     */
    protected $config;

    /**
     * @param \SprykerEco\Zed\FactFinderSdk\Persistence\FactFinderSdkQueryContainerInterface $queryContainer
     * @param \SprykerEco\Zed\FactFinderSdk\FactFinderSdkConfig $config
     */
    public function __construct(FactFinderSdkQueryContainerInterface $queryContainer, FactFinderSdkConfig $config)
    {
        $this->queryContainer = $queryContainer;
        $this->config = $config;
    }
}
