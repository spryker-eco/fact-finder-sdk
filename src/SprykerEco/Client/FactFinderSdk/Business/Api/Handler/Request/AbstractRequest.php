<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Client\FactFinderSdk\Business\Api\Handler\Request;

use SprykerEco\Client\FactFinderSdk\Business\Api\Converter\ConverterFactory;
use SprykerEco\Client\FactFinderSdk\Business\Api\FactFinderConnector;
use SprykerEco\Client\FactFinderSdk\Business\Log\LoggerTrait;

abstract class AbstractRequest
{
    use LoggerTrait;

    const TRANSACTION_TYPE = null;

    /**
     * @var \SprykerEco\Client\FactFinderSdk\Business\Api\FactFinderConnector
     */
    protected $factFinderConnector;

    /**
     * @var \SprykerEco\Client\FactFinderSdk\Business\Api\Converter\ConverterFactory
     */
    protected $converterFactory;

    /**
     * @param \SprykerEco\Client\FactFinderSdk\Business\Api\FactFinderConnector $factFinderConnector
     * @param \SprykerEco\Client\FactFinderSdk\Business\Api\Converter\ConverterFactory $converterFactory
     */
    public function __construct(
        FactFinderConnector $factFinderConnector,
        ConverterFactory $converterFactory
    ) {

        $this->factFinderConnector = $factFinderConnector;
        $this->converterFactory = $converterFactory;
    }
}
