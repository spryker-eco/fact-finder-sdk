<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Client\FactFinderSdk;

use Spryker\Zed\Kernel\AbstractBundleConfig;
use SprykerEco\Shared\FactFinderSdk\FactFinderSdkConstants;

class FactFinderSdkConfig extends AbstractBundleConfig
{
    /**
     * @return string
     */
    public function getEnvironment()
    {
        return $this->get(FactFinderSdkConstants::ENVIRONMENT);
    }

    /**
     * @return array
     */
    public function getFactFinderConfiguration()
    {
        return $this->get(FactFinderSdkConstants::ENVIRONMENT . $this->getEnvironment());
    }

    /**
     * @return string
     */
    public function getCsvDirectory()
    {
        return $this->get(FactFinderSdkConstants::CSV_DIRECTORY);
    }

    /**
     * @return string
     */
    public function getLog4PhpConfigPath()
    {
        return $this->get(FactFinderSdkConstants::PHP_LOGGER_CONFIG_PATH);
    }

    /**
     * @return string
     */
    public function getDefaultProductsPerPage()
    {
        return $this->get(FactFinderSdkConstants::DEFAULT_PRODUCTS_PER_PAGE);
    }

    /**
     * @return array
     */
    public function getItemFields()
    {
        return $this->get(FactFinderSdkConstants::ITEM_FIELDS);
    }

    /**
     * @return mixed
     */
    public function getRedirectIfOneResult()
    {
        return $this->get(FactFinderSdkConstants::REDIRECT_IF_ONE_RESULT, false);
    }
}
