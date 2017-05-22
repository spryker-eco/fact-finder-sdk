<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\FactFinderSdk;

use Spryker\Shared\Application\ApplicationConstants;
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
    public function getExportQueryLimit()
    {
        return $this->get(FactFinderSdkConstants::EXPORT_QUERY_LIMIT);
    }

    /**
     * @return string
     */
    public function getExportFileNamePrefix()
    {
        return $this->get(FactFinderSdkConstants::EXPORT_FILE_NAME_PREFIX);
    }

    /**
     * @return string
     */
    public function getExportFileNameDelimiter()
    {
        return $this->get(FactFinderSdkConstants::EXPORT_FILE_NAME_DELIMITER);
    }

    /**
     * @return string
     */
    public function getExportFileExtension()
    {
        return $this->get(FactFinderSdkConstants::EXPORT_FILE_EXTENSION);
    }

    /**
     * @return string
     */
    public function getYvesHost()
    {
        return $this->get(ApplicationConstants::HOST_YVES);
    }

}
