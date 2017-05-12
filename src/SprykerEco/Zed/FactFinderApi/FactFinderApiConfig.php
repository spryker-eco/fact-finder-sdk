<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\FactFinderApi;

use Spryker\Shared\Application\ApplicationConstants;
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
    public function getExportQueryLimit()
    {
        return $this->get(FactFinderApiConstants::EXPORT_QUERY_LIMIT);
    }

    /**
     * @return string
     */
    public function getExportFileNamePrefix()
    {
        return $this->get(FactFinderApiConstants::EXPORT_FILE_NAME_PREFIX);
    }

    /**
     * @return string
     */
    public function getExportFileNameDelimiter()
    {
        return $this->get(FactFinderApiConstants::EXPORT_FILE_NAME_DELIMITER);
    }

    /**
     * @return string
     */
    public function getExportFileExtension()
    {
        return $this->get(FactFinderApiConstants::EXPORT_FILE_EXTENSION);
    }

    /**
     * @return string
     */
    public function getYvesHost()
    {
        return $this->get(ApplicationConstants::HOST_YVES);
    }

}
