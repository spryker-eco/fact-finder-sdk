<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\FactFinderSdk;

use Spryker\Zed\Kernel\AbstractBundleConfig;
use SprykerEco\Shared\FactFinderSdk\FactFinderSdkConstants;

class FactFinderSdkConfig extends AbstractBundleConfig implements FactFinderSdkConfigInterface
{
    /**
     * @uses \Spryker\Shared\Application\ApplicationConstants::HOST_YVES
     */
    protected const HOST_YVES = 'HOST_YVES';

    /**
     * @api
     *
     * @return string
     */
    public function getEnvironment()
    {
        return $this->get(FactFinderSdkConstants::ENVIRONMENT);
    }

    /**
     * @api
     *
     * @return array
     */
    public function getFactFinderConfiguration()
    {
        return $this->get(FactFinderSdkConstants::ENVIRONMENT . $this->getEnvironment());
    }

    /**
     * @api
     *
     * @return mixed[]
     */
    public function getFactFinderProductionConfiguration(): array
    {
        return $this->get(sprintf(
            '%s%s',
            FactFinderSdkConstants::ENVIRONMENT,
            FactFinderSdkConstants::ENVIRONMENT_PRODUCTION
        ));
    }

    /**
     * @api
     *
     * @return string
     */
    public function getCsvDirectory()
    {
        return $this->get(FactFinderSdkConstants::CSV_DIRECTORY);
    }

    /**
     * @api
     *
     * @return int
     */
    public function getExportQueryLimit()
    {
        return $this->get(FactFinderSdkConstants::EXPORT_QUERY_LIMIT);
    }

    /**
     * @api
     *
     * @return string
     */
    public function getExportFileNamePrefix()
    {
        return $this->get(FactFinderSdkConstants::EXPORT_FILE_NAME_PREFIX);
    }

    /**
     * @api
     *
     * @return string
     */
    public function getExportFileNameDelimiter()
    {
        return $this->get(FactFinderSdkConstants::EXPORT_FILE_NAME_DELIMITER);
    }

    /**
     * @api
     *
     * @return string
     */
    public function getExportFileExtension()
    {
        return $this->get(FactFinderSdkConstants::EXPORT_FILE_EXTENSION);
    }

    /**
     * @api
     *
     * @return string
     */
    public function getYvesHost()
    {
        return $this->get(static::HOST_YVES);
    }

    /**
     * @api
     *
     * @return array
     */
    public function getItemFields()
    {
        return $this->get(FactFinderSdkConstants::ITEM_FIELDS);
    }

    /**
     * @api
     *
     * @return int
     */
    public function getCategoriesMaxCount()
    {
        return $this->get(FactFinderSdkConstants::CATEGORIES_MAX_COUNT);
    }
}
