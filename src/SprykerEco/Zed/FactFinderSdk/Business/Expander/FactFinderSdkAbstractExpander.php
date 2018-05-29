<?php

namespace SprykerEco\Zed\FactFinderSdk\Business\Expander;

use Generated\Shared\Transfer\LocaleTransfer;
use SprykerEco\Shared\FactFinderSdk\FactFinderSdkConstants;
use SprykerEco\Zed\FactFinderSdk\FactFinderSdkConfig;
use SprykerEco\Zed\FactFinderSdk\Persistence\FactFinderSdkQueryContainerInterface;

abstract class FactFinderSdkAbstractExpander
{
    /**
     * @var FactFinderSdkQueryContainerInterface
     */
    protected $queryContainer;
    /**
     * @var FactFinderSdkConfig
     */
    protected $config;

    /**
     * CategoryExpander constructor.
     * @param FactFinderSdkQueryContainerInterface $queryContainer
     * @param FactFinderSdkConfig $config
     */
    public function __construct(FactFinderSdkQueryContainerInterface $queryContainer, FactFinderSdkConfig $config)
    {
        $this->queryContainer = $queryContainer;
        $this->config = $config;
    }

}