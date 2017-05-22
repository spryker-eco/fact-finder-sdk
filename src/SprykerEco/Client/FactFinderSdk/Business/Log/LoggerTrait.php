<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Client\FactFinderSdk\Business\Log;

use SprykerEco\Shared\Log\LoggerFactory;

trait LoggerTrait
{

    /**
     * @return \Psr\Log\LoggerInterface
     */
    protected function getLogger()
    {
        $loggerConfig = new LoggerConfig();

        return LoggerFactory::getInstance($loggerConfig);
    }

}
