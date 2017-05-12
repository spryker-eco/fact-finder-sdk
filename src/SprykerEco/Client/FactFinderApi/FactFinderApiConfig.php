<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Client\FactFinderApi;

use Spryker\Zed\Kernel\AbstractBundleConfig;
use SprykerEco\Shared\FactFinderApi\FactFinderApiConstants;

class FactFinderApiConfig extends AbstractBundleConfig
{

    /**
     * @return string
     */
    public function getEnvironment()
    {
        return $this->get(FactFinderApiConstants::ENVIRONMENT);
    }

    /**
     * @return array
     */
    public function getFactFinderConfiguration()
    {
        return $this->get(FactFinderApiConstants::ENVIRONMENT . $this->getEnvironment());
    }

    /**
     * @return string
     */
    public function getCsvDirectory()
    {
        return $this->get(FactFinderApiConstants::CSV_DIRECTORY);
    }

    /**
     * @return string
     */
    public function getLog4PhpConfigPath()
    {
        return $this->get(FactFinderApiConstants::PHP_LOGGER_CONFIG_PATH);
    }

}
